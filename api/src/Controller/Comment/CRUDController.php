<?php

namespace App\Controller\Comment;

use App\Boundary\Input\CommentRequest;
use App\Boundary\Input\EntityRequest;
use App\Boundary\Input\IdRequest;
use App\Boundary\Output\FormatInterface;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Presenter\AuthPresenter;
use App\Presenter\CommentPresenter;
use App\Presenter\PostPresenter;
use App\UseCase\Comment\DeleteCommentUseCase;
use App\UseCase\Comment\FindCommentUseCase;
use App\UseCase\Comment\PostCommentUseCase;
use App\UseCase\Post\FindPostUseCase;
use App\UseCase\User\FindUserUseCase;
use App\ViewModel\CommentViewModel;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Comment")
 */
class CRUDController extends AbstractController
{
    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/post/{id}/comment', name: 'post_comment', methods: [Request::METHOD_POST], format: FormatInterface::JSON)]
    /**
     * @OA\RequestBody(description="Post post", @Model(type=CommentRequest::class))
     * @OA\Response(response="200", description="Post", @Model(type=CommentViewModel::class))
     */
    public function create(
        int $id,
        CommentRequest $commentRequest,
        FindUserUseCase $findUser,
        FindPostUseCase $findPost,
        PostCommentUseCase $postComment,
    ): Response {
        $commentPresenter = new CommentPresenter();

        //TODO : implement User authentication
        $userAuthId = 1;

        $findUser->execute(new IdRequest($userAuthId), $authPresenter = new AuthPresenter());
        $commentPresenter->setUser($authPresenter->getUser());

        $findPost->execute(new IdRequest($id), $postPresenter = new PostPresenter());

        $commentPresenter
            ->setPost($postPresenter->getPost());

        $postComment->execute($commentRequest, $commentPresenter);

        return $this->json($commentPresenter->getViewModel(), Response::HTTP_CREATED);
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/comment/{id}', name: 'get_comment', methods: [Request::METHOD_GET], format: FormatInterface::JSON)]
    public function read(int $id, FindCommentUseCase $findComment): Response
    {
        $findComment->execute(new IdRequest($id), $commentPresenter = new CommentPresenter());

        return $this->json($commentPresenter->getViewModel(), Response::HTTP_OK);
    }

    /**
     * @throws \Exception
     */
    #[Route('/api/comment/{id}', name: 'put_comment', methods: [Request::METHOD_PUT], format: FormatInterface::JSON)]
    public function update(
        int $id,
    ) {
        throw new \Exception('Implement this method');
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/comment/{id}', name: 'delete_comment', methods: [Request::METHOD_DELETE], format: FormatInterface::JSON)]
    public function delete(
        int $id,
        FindUserUseCase $findUser,
        FindCommentUseCase $findComment,
        DeleteCommentUseCase $deleteComment,
    ): Response {
        //TODO : implement User authentication
        $userAuthId = 1;

        $findUser->execute(new IdRequest($userAuthId), $authPresenter = new AuthPresenter());
        $findComment->execute(new IdRequest($id), $commentPresenter = new CommentPresenter());

        $commentPresenter
            ->setAuthentication($authPresenter->getUser());

        $deleteComment->execute(new EntityRequest($commentPresenter->getComment()), $commentPresenter);

        return $this->json($commentPresenter->getViewModel(), Response::HTTP_NO_CONTENT);
    }
}
