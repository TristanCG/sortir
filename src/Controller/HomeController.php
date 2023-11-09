<?php

namespace App\Controller;

use App\Repository\OutsideRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function list(OutsideRepository $outsideRepository): Response
    {
        $outsides = $outsideRepository->findAll();
        return $this->render('home/home.html.twig',
            [
                'outsides' => $outsides
            ]);
    }
    #[Route('/outisde_register/{idOutside}', name: 'outisde_register', methods: ['GET'])]
    public function register(int $idOutside, OutsideRepository $outsideRepository, EntityManagerInterface $entityManager): Response
    {
        $outside = $outsideRepository->find($idOutside);
        $user = $this->getUser();

        if ($outside && $user) {
            $outside->addParticipant($user);

            $entityManager->persist($outside);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->redirectToRoute('app_home');
    }
    #[Route('/outisde_unregister/{idOutside}', name: 'outisde_unregister', methods: ['GET'])]
    public function unregister(int $idOutside, OutsideRepository $outsideRepository, EntityManagerInterface $entityManager): Response
    {
        $outside = $outsideRepository->find($idOutside);
        $user = $this->getUser();

        if ($outside && $user) {
            $outside->removeParticipant($user);

            $entityManager->persist($outside);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->redirectToRoute('app_home');
    }
}
