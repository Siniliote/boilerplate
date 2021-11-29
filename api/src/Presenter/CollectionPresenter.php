<?php

namespace App\Presenter;

use App\Boundary\Output\CollectionResponse;
use App\Boundary\Output\ResponseInterface;

class CollectionPresenter implements PresenterInterface
{
    private array $elements = [];

    public function __construct(private string $presenterClass)
    {
    }

    /**
     * @throws \Exception
     */
    public function present(ResponseInterface $response): void
    {
        if (!$response instanceof CollectionResponse) {
            throw new \Exception();
        }

        foreach ($response as $element) {
            $presenter = new $this->presenterClass();
            $presenter->present($element);

            $this->elements[] = $presenter;
        }
    }

    public function getViewModel(): array
    {
        $viewModels = [];

        foreach ($this->elements as $element) {
            $viewModels[] = $element->getViewModel();
        }

        return $viewModels;
    }
}
