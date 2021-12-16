<?php

namespace App\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonBodySerializableConverter implements ParamConverterInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $body = $request->getContent();

        if (empty($body)) {
            return false;
        }

        $object = $this->serializer->deserialize($body, $configuration->getClass(), 'json');
        $request->attributes->set($configuration->getName(), $object);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        $class = $configuration->getClass();
        if (!\is_string($class)) {
            return false;
        }

        return \in_array(JsonBodySerializableInterface::class, class_implements($class), true);
    }
}
