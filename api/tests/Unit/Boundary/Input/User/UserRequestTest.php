<?php

namespace App\Tests\Unit\Boundary\Input\User;

use App\Boundary\Input\User\UserRequest;
use App\Tests\Unit\Boundary\Input\RequestTestInterface;
use PHPUnit\Framework\TestCase;

class UserRequestTest extends TestCase implements RequestTestInterface
{
    public function testSetterAndGetter(): void
    {
        $userRequest = new UserRequest();

        $userRequest->setName($name = 'Test');
        $this->assertStringContainsString($name, $userRequest->getName());
    }
}
