<?php

namespace App\UseCase\Comment;

use App\Boundary\Input\Comment\CommentRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ErrorResponse;
use App\Entity\Comment;
use App\Gateway\CommentGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\User\FindUserUseCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostCommentUseCase
{
    public function __construct(
        private CommentGateway $gateway,
        private ValidatorInterface $validator,
        private FindUserUseCase $userUseCase,
    ) {
    }

    public function execute(
        CommentRequest $request,
        PresenterInterface $presenter
    ): void {
        $isValid = $this->isValid($request, $presenter);

        if (!$isValid) {
            return;
        }

        $this->userUseCase->execute($request->getUser());

        $this->gateway->create($comment = (new Comment())
                                            ->setBody($request->getBody()));

        $presenter->present(new CommentResponse($comment));
    }

    private function isValid(RequestInterface $request, PresenterInterface $presenter): bool
    {
        $violationList = $this->validator->validate($request);

        if ($violationList->count() > 0) {
            $presenter->present(new ErrorResponse());
        }

        return true;
    }
}
