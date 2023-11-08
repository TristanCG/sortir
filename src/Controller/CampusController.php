<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusType;
use App\Repository\CampusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CampusController extends AbstractController
{
    #[Route('/campus', name: 'app_campus', methods: ['GET', 'POST'])]
    public function list(CampusRepository $campusRepository, Request $request, EntityManagerInterface $em): Response
    {
        $campus = $campusRepository->findAll();
        $campusForm = $this->createForm(CampusType::class);

        $campusForm->handleRequest($request);

        if ($campusForm->isSubmitted() && $campusForm->isValid()) {
            // Créez une instance de Campus avec les données du formulaire
            $campusData = $campusForm->getData();

            // Persistez l'entité Campus
            $em->persist($campusData);

            // Exécutez la requête pour enregistrer l'entité dans la base de données
            $em->flush();

            // Redirigez l'utilisateur vers la page 'app_campus' après l'ajout
            return $this->redirectToRoute('app_campus');
        }

        return $this->render('campus/index.html.twig', [
            'campus' => $campus,
            'campusForm' => $campusForm->createView(),
        ]);
    }

    #[Route('/campus/edit', name: 'campus_edite', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
        $campusForm = $this->createForm(CampusType::class);

        $campusForm->handleRequest($request);

        return $this->render('campus/edit.html.twig', [
            'campusForm' => $campusForm->createView(),
        ]);
    }

    #[Route('/campus/{id}/delete', name: 'campus_delete', methods: ['GET'])]
    public function delete(int $id, CampusRepository $campusRepository, EntityManagerInterface $entityManager): Response
    {
        $campus = $campusRepository->find($id);

        if($campus){
            $entityManager->remove($campus);
            $entityManager->flush();
        } else {
            return $this->redirectToRoute('app_campus');
        }
        return $this->redirectToRoute('app_campus');
    }
}
