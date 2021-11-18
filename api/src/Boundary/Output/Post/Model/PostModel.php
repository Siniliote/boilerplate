<?php

namespace App\Boundary\Output\Post\Model;

class PostModel
{
    public ?int $id = null;
    private string $title;
    private string $body;
    private ?string $shortDescription;
    private int $viewCount = 0;
    private ?\DateTime $createdAt;
    private ?\DateTime $publishedAt = null;
    private ?CategoryModel $category = null;
    /** @var TagModel[] */
    private array $tags;

//    private array $comments;

    public function __construct(string $title, string $body, ?string $shortDescription = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->shortDescription = $shortDescription;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getCategory(): ?CategoryModel
    {
        return $this->category;
    }

    public function setCategory(?CategoryModel $category): self
    {
        $this->category = $category;

        return $this;
    }

    /** @return TagModel[] */
    public function getTags(): array
    {
        return $this->tags;
    }

    /** @param TagModel[] $tags */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function addTags(TagModel $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }
}
