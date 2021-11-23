<?php

namespace App\Controller\Comment;

use App\Boundary\Input\Comment\CommentRequest;
use App\Boundary\Input\IdRequest;
use App\Boundary\Output\FormatInterface;
use App\UseCase\Comment\PostCommentUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CRUDController extends AbstractController
{
    #[Route('/api/comment', name: 'post_comment', methods: [Request::METHOD_POST], format: FormatInterface::JSON)]
    public function create(
        CommentRequest $comment,
        PostCommentUseCase $useCase
    ) {
        dump($comment);
        exit;
    }

    #[Route('/api/comment/{id<\d+>}', name: 'get_comment', methods: [Request::METHOD_GET], format: FormatInterface::JSON)]
    public function read(IdRequest $id)
    {
    }

    #[Route('/api/comment/{id<\d+>}', name: 'put_comment', methods: [Request::METHOD_PUT], format: FormatInterface::JSON)]
    public function update(IdRequest $id, CommentRequest $comment)
    {
    }

    #[Route('/api/comment/{id<\d+>}', name: 'delete_comment', methods: [Request::METHOD_DELETE], format: FormatInterface::JSON)]
    public function delete(IdRequest $id)
    {
    }
}
