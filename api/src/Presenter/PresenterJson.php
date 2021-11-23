<?php

namespace App\Presenter;

use App\Boundary\Output\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class PresenterJson implements PresenterInterface
{
    public function __construct(public SerializerInterface $serializer)
    {
    }

    public function present(ResponseInterface $response): JsonResponse
    {
        $data = [];

        return $this->json($data);
    }

    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     */
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $json = $this->serializer->serialize($data, 'json', array_merge([
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ], $context));

        return new JsonResponse($json, $status, $headers, true);
    }
}
