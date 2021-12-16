<?php

namespace App\UseCase\Comment;

use App\Boundary\Input\EmptyRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\CollectionResponse;
use App\Boundary\Output\CommentResponse;
use App\Exception\InvalidRequestException;
use App\Gateway\CommentGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FindAllCommentUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private CommentGateway $commentGateway,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param EmptyRequest $request
     *
     * @throws InvalidRequestException
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isValid($request);

        $comment = $this->commentGateway->findAll();

        $presenter->present(new CollectionResponse(CommentResponse::class, $comment));
    }
}
