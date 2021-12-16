<?php

namespace App\Boundary\Output;

use App\Common\Collections\ArrayCollection;

class CollectionResponse extends ArrayCollection implements ResponseInterface
{
    public function __construct(
        private string $responseClass,
        array $elements = [],
    ) {
        $objectElements = [];
        foreach ($elements as $element) {
            $objectElements[] = new $this->responseClass($element);
        }

        parent::__construct($objectElements);
    }
}
