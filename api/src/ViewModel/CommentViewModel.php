<?php

namespace App\ViewModel;

class CommentViewModel
{
    public function __construct(
        public string $author,
        public string $title,
        public string $body,
    ) {
    }
}
