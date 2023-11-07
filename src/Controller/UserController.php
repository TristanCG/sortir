<?php

namespace App\Controller;

use App\Repository\UserRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/manager', name: 'user_list', methods: ['GET'])]
    public function list(UserRepository $userRepository): Response
    {

        $users = $userRepository->findAll();
        return $this->render('user/list.html.twig',
        ['users' => $users]);
    }

    #[Route('/{id}/disable', name: 'user_disable', methods: ['GET'])]
    public function disable(int $id): Response
    {
        return $this->render('user/list.html.twig');
    }

    #[Route('/{id}/disable', name: 'user_delete', methods: ['GET'])]
    public function delete(int $id): Response
    {
        return $this->render('user/list.html.twig');
    }

    #[Route('/create', name: 'user_create', methods: ['GET', 'POST'])]
    public function create(): Response
    {
        return $this->render('user/create.html.twig');
    }
}
