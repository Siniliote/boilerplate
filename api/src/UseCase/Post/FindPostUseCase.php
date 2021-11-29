<?php

namespace App\UseCase\Post;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\PostResponse;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Gateway\PostGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FindPostUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private PostGateway $gateway,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param IdRequest $request
     *
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isValid($request);

        $post = $this->gateway->find($request->getId());

        if (!$post) {
            throw new NotFoundResourceException('Post not found');
        }

        $presenter->present(new PostResponse($post));
    }
}
