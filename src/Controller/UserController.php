<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function disable(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        if ($user) {
            $user->setActive(false);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_list');
        } else {
            return $this->redirectToRoute('user_list');
        }
    }
    #[Route('/{id}/enable', name: 'user_enable', methods: ['GET'])]
    public function enable(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        if ($user) {
            $user->setActive(true);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_list');
        } else {
            return $this->redirectToRoute('user_list');
        }
    }

    #[Route('/{id}/delete', name: 'user_delete', methods: ['GET'])]
    public function delete(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        if ($user) {
            // Supprimez l'utilisateur
            $entityManager->remove($user);
            $entityManager->flush();
        } else {
            // Gérez le cas où l'utilisateur n'est pas trouvé, par exemple, en affichant un message d'erreur.
            return $this->redirectToRoute('user_list');
        }

        // Redirigez vers la route 'user_list' ou ailleurs après la suppression
        return $this->redirectToRoute('user_list');
    }

    #[Route('/create', name: 'user_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);

        return $this->render('user/create.html.twig', ['userForm' => $userForm]);
    }
}