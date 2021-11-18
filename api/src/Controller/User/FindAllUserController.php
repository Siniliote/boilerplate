<?php

namespace App\Controller\User;

use App\Boundary\Input\EmptyRequest;
use App\Boundary\Output\User\UserListResponse;
use App\UseCase\User\FindAllUserUseCase;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FindAllUserController extends AbstractController
{
    public function __construct(protected FindAllUserUseCase $useCase)
    {
    }

    /**
     * @OA\Tag(name="User")
     * @OA\Response(response="200", description="Find all users", @Model(type=UserListResponse::class))
     */
    #[Route('/api/user/', name: 'get_users', methods: ['GET'], format: 'json')]
    public function __invoke(): Response
    {
        $request = new EmptyRequest();
        $response = new UserListResponse();

        $this->useCase->execute($request, $response);

        return $this->json($response);
    }
}
