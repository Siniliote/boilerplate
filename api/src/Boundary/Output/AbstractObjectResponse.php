<?php

namespace App\Boundary\Output;

use App\Dto\DtoInterface;

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

    abstract protected function getDto(): DtoInterface;

    public function getResult(): array
    {
        $result = parent::getResult();
        $result['data'] = !$this->hasError() ? $this->getDto() : [];

        return $result;
    }
}
