<?php

namespace App\Boundary\Output;

/**
 * @template T
 */
abstract class AbstractObjectResponse extends AbstractResponse
{
    /**
     * @var ?T
     */
    private $data = null;

    /**
     * @return ?T
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param T $data
     *
     * @return $this
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}
