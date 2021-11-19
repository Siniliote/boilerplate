<?php

namespace App\Boundary\Output;

/**
 * @template T
 */
abstract class AbstractListResponse extends AbstractResponse
{
    /**
     * @var array<int, T>
     */
    private array $data = [];

    /**
     * @return array<int, T>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array<int, T> $data
     *
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param T $userDto
     *
     * @return $this
     */
    public function addData($userDto): self
    {
        $this->data[] = $userDto;

        return $this;
    }
}
