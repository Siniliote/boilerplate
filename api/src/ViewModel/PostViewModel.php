<?php

namespace App\ViewModel;

class PostViewModel
{
    public function __construct(
        public string $title,
        public string $body,
        public string $createdAt,
        public ?string $shortDescription = null,
        public int $viewCount = 0,
        public ?string $publishedAt = null,
        public ?string $categoryName = null,
        public array $tags = [],
        public array $comments = [],
    ) {
    }
}
