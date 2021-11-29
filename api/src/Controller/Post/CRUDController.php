<?php

namespace App\Controller\Post;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\PostRequest;
use App\Boundary\Output\FormatInterface;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Presenter\AuthPresenter;
use App\Presenter\CategoryPresenter;
use App\Presenter\PostPresenter;
use App\UseCase\Category\FindCategoryUseCase;
use App\UseCase\Post\FindPostUseCase;
use App\UseCase\Post\PostPostUseCase;
use App\UseCase\User\FindUserUseCase;
use App\ViewModel\PostViewModel;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Post")
 */
class CRUDController extends AbstractController
{
    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/post', name: 'post_post', methods: [Request::METHOD_POST], format: FormatInterface::JSON)]
    /**
     * @OA\RequestBody(description="Post post", @Model(type=PostRequest::class))
     * @OA\Response(response="200", description="Post", @Model(type=PostViewModel::class))
     */
    public function create(
        PostRequest $postRequest,
        FindUserUseCase $findUser,
        FindCategoryUseCase $findCategory,
        PostPostUseCase $postPost,
    ): Response {
        $postPresenter = new PostPresenter();

        //TODO : implement User authentication
        $userAuthId = 1;

        $findUser->execute(new IdRequest($userAuthId), $authPresenter = new AuthPresenter());
        $postPresenter->setUser($authPresenter->getUser());

        if ($category = $postRequest->getCategory()) {
            $findCategory->execute($category, $categoryPresenter = new CategoryPresenter());
            $postPresenter->setCategory($categoryPresenter->getCategory());
        }

        $postPost->execute($postRequest, $postPresenter);

        return $this->json($postPresenter->getViewModel(), Response::HTTP_CREATED);
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/post/{id}', name: 'get_post', methods: [Request::METHOD_GET], format: FormatInterface::JSON)]
    public function read(int $id, FindPostUseCase $findPost): Response
    {
        $findPost->execute(new IdRequest($id), $postPresenter = new PostPresenter());

        return $this->json($postPresenter->getViewModel(), Response::HTTP_OK);
    }

    /**
     * @throws \Exception
     */
    #[Route('/api/post/{id}', name: 'put_post', methods: [Request::METHOD_PUT], format: FormatInterface::JSON)]
    public function update(
        int $id,
    ) {
        throw new \Exception('Implement this method');
    }

    /**
     * @throws \Exception
     */
    #[Route('/api/post/{id}', name: 'delete_post', methods: [Request::METHOD_DELETE], format: FormatInterface::JSON)]
    public function delete(
        int $id,
    ) {
        throw new \Exception('Implement this method');
    }
}
