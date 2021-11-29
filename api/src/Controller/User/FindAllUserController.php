<?php

namespace App\Controller\User;

use App\Boundary\Input\EmptyRequest;
use App\Boundary\Output\FormatInterface;
use App\Presenter\CollectionPresenter;
use App\Presenter\UserPresenter;
use App\UseCase\User\FindAllUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FindAllUserController extends AbstractController
{
    #[Route('/api/comment', name: 'get_all_user', methods: [Request::METHOD_GET], format: FormatInterface::JSON)]
    public function __invoke(FindAllUserUseCase $findAllComment): Response
    {
        $findAllComment->execute(new EmptyRequest(), $presenter = new CollectionPresenter(UserPresenter::class));

        return $this->json($presenter->getViewModel(), Response::HTTP_OK);
    }
}
