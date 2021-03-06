<?php

namespace App\Boundary\Input;

use App\Request\ParamConverter\JsonBodySerializableInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostRequest implements RequestInterface, JsonBodySerializableInterface
{
    #[Assert\Length(min: 15, max: 30)]
    private ?string $shortDescription = null;
    private int $viewCount = 0;
    private ?\DateTime $publishedAt = null;
    private ?IdRequest $category = null;

    /** @var int[] */
    private array $tags = [];

    public function __construct(
        #[Assert\NotBlank] #[Assert\Length(min: 2, max: 50)] private string $title,
        #[Assert\NotBlank] #[Assert\Length(min: 15)] private string $body,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCategory(): ?IdRequest
    {
        return $this->category;
    }

    public function setCategory(?IdRequest $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return int[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param int[] $tags
     */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }
}
