<?php

namespace App\Boundary\Input;

use App\Request\ParamConverter\JsonBodySerializableInterface;

class EntityRequest implements RequestInterface, JsonBodySerializableInterface
{
    /** @var object */
    private $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity($entity): self
    {
        $this->entity = $entity;

        return $this;
    }
}
