<?php

namespace App\Controller;

use App\Boundary\Output\BookResponse;
use App\Boundary\Output\PageResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class GetBookController extends AbstractController
{
    /**
     * @OA\Response(response="200", description="An example resource", @Model(type=BookResponse::class))
     */
    #[Route('/api/book', name: 'get_book', methods: ['GET'], format: 'json')]
    public function __invoke(): Response
    {
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
