<?php

namespace App\UseCase\Post;

use App\Boundary\Input\Post\PostRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\Category\CategoryResponse;
use App\Boundary\Output\Post\PostResponse;
use App\Boundary\Output\ResponseInterface;
use App\Entity\Category;
use App\Entity\Post;
use App\Gateway\PostGateway;
use App\UseCase\AbstractPostUseCase;
use App\UseCase\Category\FindCategoryUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostPostUseCase extends AbstractPostUseCase implements UseCaseInterface
{
    public function __construct(
        ValidatorInterface $validator,
        private PostGateway $gateway,
        private FindCategoryUseCase $categoryUseCase
    ) {
        parent::__construct($validator);
    }

    /**
     * @param PostRequest  $request
     * @param PostResponse $response
     */
    public function execute(RequestInterface $request, ResponseInterface $response): void
    {
        if (!$this->isValid($request, $response)) {
            return;
        }

        $post = $this->transform($request);
        $this->getCategory($request, $response, $post);
        $this->gateway->create($post);
        $response->setData($post);
    }

    private function getCategory(PostRequest $request, PostResponse $response, Post $post): void
    {
        if ($request->getCategory()) {
            $responseCategory = new CategoryResponse();
            $this->categoryUseCase->execute($request->getCategory(), $responseCategory);
            if ($responseCategory->hasError()) {
                $response
                    ->setStatus($response::BAD_REQUEST)
                    ->setErrors($responseCategory->getErrors());

                return;
            }

            $post->setCategory($responseCategory->getData());
        }
    }

    public function transform(PostRequest $request): Post
    {
        $post = (new Post(
            $request->getTitle(),
            $request->getBody(),
            $request->getShortDescription()
        ))->setPublishedAt($request->getPublishedAt())
            ->setViewCount($request->getViewCount());
        if ($category = $request->getCategory()) {
            $post->setCategory(new Category())->setId($category->getId());
        }

        return $post;
    }
}
