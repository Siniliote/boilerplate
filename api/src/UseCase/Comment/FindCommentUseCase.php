<?php

namespace App\UseCase\Comment;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\CommentResponse;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Gateway\CommentGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FindCommentUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private CommentGateway $commentGateway,
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

        $comment = $this->commentGateway->find($request->getId());

        if (!$comment) {
            throw new NotFoundResourceException('Comment not found');
        }

        $presenter->present(new CommentResponse($comment));
    }
}
