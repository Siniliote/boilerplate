<?php

namespace App\Tests\Unit\Boundary\Input;

use App\Boundary\Input\UserRequest;
use PHPUnit\Framework\TestCase;

class UserRequestTest extends TestCase
{
    public function testSetterAndGetter(): void
    {
        $userRequest = new UserRequest();

        $userRequest->setName($name = 'Test');
        $this->assertStringContainsString($name, $userRequest->getName());
    }
}
