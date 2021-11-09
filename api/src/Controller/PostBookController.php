<?php

namespace App\Controller;

use App\Boundary\Input\BookRequest;
use App\Boundary\Output\BookResponse;
use App\Boundary\Output\PageResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\Serializer\SerializerInterface;

class PostBookController extends AbstractController
{
    public function __construct(public SerializerInterface $serializer)
    {
    }

    /**
     * @OA\RequestBody(description="An example resource", @Model(type=BookRequest::class))
     * @OA\Response(response="200", description="An example resource", @Model(type=BookResponse::class))
     */
    #[Route('/api/book', name: 'post_book', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $bookRequest = $this->serializer->deserialize($request->getContent(), BookRequest::class, 'json');

        $pageResponse = (new PageResponse())->setNumber(1)->setTitle('Ma page de test');

        $response = new BookResponse();
        $response->setPath('src/Controller/FiercePuppyController.php')
            ->setMessage('Welcome to your new controller!')
            ->addPage($pageResponse);

        return $this->json(
            $response
        );
    }
}
