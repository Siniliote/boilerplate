<?php

namespace App\Controller\User;

use App\Boundary\Input\IdRequest;
use App\Boundary\Output\User\UserResponse;
use App\UseCase\User\FindUserUseCase;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FindUserController extends AbstractController
{
    public function __construct(protected FindUserUseCase $useCase)
    {
    }

    /**
     * @OA\Tag(name="User")
     * @OA\Response(response="200", description="Find user", @Model(type=UserResponse::class))
     */
    #[Route('/api/user/{id<\d+>}', name: 'get_user', methods: ['GET'], format: 'json')]
    public function __invoke(int $id): Response
    {
        $request = new IdRequest($id);
        $response = new UserResponse();
        $this->useCase->execute($request, $response);

        return $this->json($response);
    }
}
