<?php

namespace App\Tests\Unit\Boundary\Input\Post;

use App\Boundary\Input\Post\PostRequest;
use App\Tests\Unit\Boundary\Input\RequestTestInterface;
use PHPUnit\Framework\TestCase;

class PostRequestTest extends TestCase implements RequestTestInterface
{
    public function testSetterAndGetter(): void
    {
        $postRequest = new PostRequest();
        $proprieties = [
            'title' => 'test',
            'body' => 'test',
            'shortDescription' => 'test',
            'viewCount' => 0,
            'publishedAt' => new \DateTime(),
            'category' => 1,
        ];

        foreach ($proprieties as $propriety => $value) {
            $postRequest->{'set'.ucfirst($propriety)}($value);
            $this->assertSame($value, $postRequest->{'get'.ucfirst($propriety)}());
        }
    }
}
