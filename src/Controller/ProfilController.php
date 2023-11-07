<?php

namespace App\Controller;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this->getUser(); // Obtenir l'utilisateur actuel

        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submittedData = $form->getData(); // Récupérer les données soumises par le formulaire

            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Le profil a bien été enregistré');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('profil/profil.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
