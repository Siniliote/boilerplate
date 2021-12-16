<?php

namespace App\Controller\User;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\UserRequest;
use App\Boundary\Output\FormatInterface;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Presenter\AuthPresenter;
use App\Presenter\UserPresenter;
use App\UseCase\Category\FindCategoryUseCase;
use App\UseCase\User\FindUserUseCase;
use App\UseCase\User\PostUserUseCase;
use App\ViewModel\UserViewModel;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="User")
 */
class CRUDController extends AbstractController
{
    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/user', name: 'user_user', methods: [Request::METHOD_POST], format: FormatInterface::JSON)]
    /**
     * @OA\RequestBody(description="User user", @Model(type=UserRequest::class))
     * @OA\Response(response="200", description="User", @Model(type=UserViewModel::class))
     */
    public function create(
        UserRequest $userRequest,
        FindUserUseCase $findUser,
        FindCategoryUseCase $findCategory,
        PostUserUseCase $userUser,
    ): Response {
        $userPresenter = new UserPresenter();

        //TODO : implement User authentication
        $userAuthId = 1;

        $findUser->execute(new IdRequest($userAuthId), $authPresenter = new AuthPresenter());
        $userPresenter->setUser($authPresenter->getUser());

        $userUser->execute($userRequest, $userPresenter);

        return $this->json($userPresenter->getViewModel(), Response::HTTP_CREATED);
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    #[Route('/api/user/{id}', name: 'get_user', methods: [Request::METHOD_GET], format: FormatInterface::JSON)]
    public function read(int $id, FindUserUseCase $findUser): Response
    {
        $findUser->execute(new IdRequest($id), $userPresenter = new UserPresenter());

        return $this->json($userPresenter->getViewModel(), Response::HTTP_OK);
    }

    /**
     * @throws \Exception
     */
    #[Route('/api/user/{id}', name: 'put_user', methods: [Request::METHOD_PUT], format: FormatInterface::JSON)]
    public function update(
        int $id,
    ) {
        throw new \Exception('Implement this method');
    }

    /**
     * @throws \Exception
     */
    #[Route('/api/user/{id}', name: 'delete_user', methods: [Request::METHOD_DELETE], format: FormatInterface::JSON)]
    public function delete(
        int $id,
    ) {
        throw new \Exception('Implement this method');
    }
}
