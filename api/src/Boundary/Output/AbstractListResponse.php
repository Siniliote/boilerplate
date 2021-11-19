<?php

namespace App\Boundary\Output;

use App\Dto\DtoInterface;

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
     * @param T $user
     *
     * @return $this
     */
    public function addData($user): self
    {
        $this->data[] = $user;

        return $this;
    }

    /**
     * @param T $entity
     */
    abstract protected function getDto($entity): DtoInterface;

    public function getResult(): array
    {
        $result = parent::getResult();
        if (!$this->hasError()) {
            foreach ($this->getData() as $entity) {
                $result['data'][] =
                    $this->getDto($entity);
            }
        } else {
            $result['data'] = [];
        }

        return $result;
    }
}
