<?php

namespace App\UseCase\Post;

use App\Boundary\Input\Post\PostRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\Post\PostResponse;
use App\Boundary\Output\ResponseInterface;
use App\DataTransformer\PostDataTransformer;
use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use App\Gateway\CategoryGateway;
use App\Gateway\PostGateway;
use App\Gateway\TagGateway;
use App\UseCase\AbstractPostUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostPostUseCase extends AbstractPostUseCase implements UseCaseInterface
{
    public function __construct(
        ValidatorInterface $validator,
        private PostGateway $postGateway,
        private CategoryGateway $categoryGateway,
        private TagGateway $tagGateway,
        private PostDataTransformer $dataTransformer
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

        try {
            $post = $this->buildEntity($request);
            $this->postGateway->create($post);
            $response->setData($this->dataTransformer->reverseTransform($post));
        } catch (CategoryNotFoundException|TagNotFoundException $exception) {
            $response
                ->setStatus($response::NOT_FOUND)
                ->addError($exception->getMessage());
        }
    }

    /**
     * @throws CategoryNotFoundException
     * @throws TagNotFoundException
     */
    private function buildEntity(PostRequest $request): Post
    {
        $post = $this->dataTransformer->transform($request);

        if ($request->getCategory()) {
            $category = $this->findCategory($request);
            $post->setCategory($category);
        }
        if (\count($request->getTags()) > 0) {
            foreach ($this->findTags($request) as $tag) {
                $post->addTag($tag);
            }
        }

        return $post;
    }

    /**
     * @throws CategoryNotFoundException
     */
    private function findCategory(PostRequest $request): Category
    {
        $category = $this->categoryGateway->find($request->getCategory());
        if (!$category) {
            throw new CategoryNotFoundException('Category not found');
        }

        return $category;
    }

    /**
     * @throws TagNotFoundException
     *
     * @return Tag[]
     */
    private function findTags(PostRequest $request): array
    {
        $tags = $this->tagGateway->findById($request->getTags());

        if (\count($tags) !== \count($request->getTags())) {
            throw new TagNotFoundException('One or many tag not found');
        }

        return $tags;
    }
}
