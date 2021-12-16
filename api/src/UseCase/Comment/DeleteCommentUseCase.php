<?php

namespace App\UseCase\Comment;

use App\Boundary\Input\EntityRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\CommentResponse;
use App\Entity\User;
use App\Exception\InvalidRequestException;
use App\Gateway\CommentGateway;
use App\Presenter\CommentPresenter;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DeleteCommentUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private CommentGateway $commentGateway,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param EntityRequest    $request
     * @param CommentPresenter $presenter
     *
     * @throws InvalidRequestException
     * @throws \Exception
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isAdmin($presenter->getAuthentication()) || $this->isOwner($presenter->getAuthentication(), $presenter->getUser());

        $this->commentGateway->delete($request->getEntity());

        $presenter->present(new CommentResponse($request->getEntity()));
    }

    private function isAdmin(User $user): bool
    {
        if ('admin' !== $user->getName()) {
            return false;
        }

        return true;
    }

    /**
     * @throws InvalidRequestException
     */
    private function isOwner(User $userAuth, User $user): bool
    {
        if ($userAuth->getId() !== $user->getId()) {
            throw new InvalidRequestException('Not owner');
        }

        return true;
    }
}
