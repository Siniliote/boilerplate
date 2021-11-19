<?php

namespace App\Controller\Post;

use App\Boundary\Input\Post\PostRequest;
use App\Boundary\Output\FormatInterface;
use App\Boundary\Output\Post\PostResponse;
use App\UseCase\Post\PostPostUseCase;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PostController extends AbstractController
{
    public function __construct(private PostPostUseCase $useCase, private SerializerInterface $serializer)
    {
    }

    /**
     * @OA\Tag(name="Post")
     * @OA\RequestBody(description="Post post", @Model(type=PostRequest::class))
     * @OA\Response(response="200", description="Post", @Model(type=PostResponse::class))
     */
    #[Route('/api/post', name: 'post_post', methods: ['POST'], format: FormatInterface::JSON)]
    public function __invoke(Request $request): Response
    {
        $request = $this->serializer->deserialize($request->getContent(), PostRequest::class, FormatInterface::JSON);
        $response = new PostResponse();
        $this->useCase->execute($request, $response);

        return $this->json($response);
    }
}
