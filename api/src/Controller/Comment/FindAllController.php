<?php

namespace App\Controller\Comment;

use App\Boundary\Input\EmptyRequest;
use App\Boundary\Output\FormatInterface;
use App\Exception\InvalidRequestException;
use App\Presenter\CollectionPresenter;
use App\Presenter\CommentPresenter;
use App\UseCase\Comment\FindAllCommentUseCase;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Comment")
 */
class FindAllController extends AbstractController
{
    /**
     * @throws InvalidRequestException
     */
    #[Route('/api/comment', name: 'get_all_comment', methods: [Request::METHOD_GET], format: FormatInterface::JSON)]
    public function __invoke(FindAllCommentUseCase $findAllComment): JsonResponse
    {
        $findAllComment->execute(new EmptyRequest(), $presenter = new CollectionPresenter(CommentPresenter::class));

        return $this->json($presenter->getViewModel(), Response::HTTP_OK);
    }
}
