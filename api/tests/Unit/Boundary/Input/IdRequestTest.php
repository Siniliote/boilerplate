<?php

namespace App\Tests\Unit\Boundary\Input;

use App\Boundary\Input\IdRequest;
use PHPUnit\Framework\TestCase;

class IdRequestTest extends TestCase implements RequestTestInterface
{
    public function testSetterAndGetter(): void
    {
        $idRequest = new IdRequest($id = 1);

        $this->assertSame($id, $idRequest->getId());
    }
}
