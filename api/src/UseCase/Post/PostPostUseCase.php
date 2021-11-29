<?php

namespace App\UseCase\Post;

use App\Boundary\Input\PostRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\PostResponse;
use App\Entity\Post;
use App\Exception\InvalidRequestException;
use App\Gateway\PostGateway;
use App\Presenter\PostPresenter;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\Category\FindCategoryUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostPostUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private PostGateway $postGateway,
        private FindCategoryUseCase $findCategoryUseCase,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param PostRequest   $request
     * @param PostPresenter $presenter
     *
     * @throws InvalidRequestException
     * @throws \Exception
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isValid($request);

        $post = new Post(
            $request->getTitle(),
            $request->getBody(),
            $request->getShortDescription() ?? null
        );

        if (null !== $request->getCategory()) {
            $this->findCategoryUseCase->execute($request->getCategory(), $presenter);
            $post->setCategory($presenter->getCategory());
        }

        $this->postGateway->create($post);

        $presenter->present(new PostResponse($post));
    }
}
