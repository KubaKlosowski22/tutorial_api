<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    #[Route('/users', name: 'find_all_users')]
    public function findAll(UserRepository $repository): JsonResponse
    {            
        $users = $repository->getAll();
        return $this->json($users, Response::HTTP_OK);
    }


    #[Route('/users/{id}', name: 'find_one_user')]
    public function findOne(UserRepository $repository, string $id): JsonResponse
    {
        $user = $repository->find($id);
        
        if (!$user) {
            return $this->json(['details' => "User with id {$id} not found"], Response::HTTP_NOT_FOUND);
        }
        
        $response = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'password' => $user->getPassword() 
        ];
        
        return $this->json($response, Response::HTTP_OK);
    }
}
