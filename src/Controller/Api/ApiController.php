<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    public function __construct(private NormalizerInterface $normalizer)
    {
    }

    public function createJsonResponse(mixed $data, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse(
            $this->normalizer->normalize($data, 'json'),
            $statusCode
        );
    }
}
