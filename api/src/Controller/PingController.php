<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api', name: 'api_', format: 'json')]
final class PingController extends AbstractController
{
    #[Route('/ping', name: 'ping', methods: ['GET'])]
    public function ping(): JsonResponse
    {
        return $this->json(['status' => 'ok', 'league' => 'GG League']);
    }

    #[Route('/hello/{name}', name: 'hello', methods: ['GET'], requirements: ['name' => '[A-Za-z0-9_]{2,30}'])]
    public function hello(string $name): JsonResponse
    {
        return $this->json(['message' => sprintf('GG %s !', $name)]);
    }
}
