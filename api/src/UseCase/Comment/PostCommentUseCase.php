<?php

namespace App\UseCase\Comment;

use App\Boundary\Input\CommentRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\CommentResponse;
use App\Entity\Comment;
use App\Exception\InvalidRequestException;
use App\Gateway\CommentGateway;
use App\Presenter\CommentPresenter;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostCommentUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private CommentGateway $commentGateway,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param CommentRequest   $request
     * @param CommentPresenter $presenter
     *
     * @throws InvalidRequestException
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isValid($request);

        $comment = new Comment($presenter->getUser(), $request->getBody());

        $presenter->getPost()->addComment($comment);
        $this->commentGateway->create($comment);

        $presenter->present(new CommentResponse($comment));
    }
}
