<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends ApiController
{
    #[Route('/users', name: 'find_all_users')]
    public function findAll(UserRepository $repository, SerializerInterface $serializer): Response
    {
        $users = $repository->findAll();

        return $this->createJsonResponse($users, Response::HTTP_OK);
    }


    #[Route('/users/{id}', name: 'find_one_user')]
    public function findOne(UserRepository $repository, string $id): JsonResponse
    {
        $user = $repository->find($id);

        if (!$user) {
            return $this->json(['details' => "User with id {$id} not found"], Response::HTTP_NOT_FOUND);
        }

        return $this->createJsonResponse($user, Response::HTTP_OK);
    }
}
