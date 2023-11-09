<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Entity\Outside;
use App\Form\OutsideType;
use App\Repository\CityRepository;
use App\Repository\PlaceRepository;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutsideController extends AbstractController
{
    #[Route('/create_outside', name: 'app_create_outside', methods: ['GET', 'POST'])]
    public function index(
        PlaceRepository $placeRepository, // Paramètre permettant d'accéder à Place
        CityRepository $cityRepository, // Paramètre permettant d'accéder à City
        StatutRepository $statutRepository, // Paramètre permettant d'accéder à Statut
        Request $request, // Paramètre permettant d'accéder aux données
        EntityManagerInterface $em //Parmètre permettant une bonne gestion des entit
    ): Response
    {

        // Creation d'une sortie
        $outside = new Outside();
        $outside->setPromoter($this->getUser());

        // Modification ici pour récupérer le statut correctement
        $statutId = 7; // Remplacez 1 par l'ID du statut que vous souhaitez attribuer
        $statut = $statutRepository->find($statutId);   // Récupération de l'Id de la table Statut
        $outside->setStatut($statut);

        // Modification ici pour récupérer le place correctement
        $placeId = 2; // Remplacez 1 par l'ID du statut que vous souhaitez attribuer
        $place = $placeRepository->find($placeId); // Récupération de l'Id de la table Place
        $outside->setPlace($place);

        // Création d'un formulaire de sortie
        $outsideForm = $this->createForm(OutsideType::class, $outside);
        // Permet de récupérer les données et de les associer au formualire de sortie
        $outsideForm->handleRequest($request);



        // On check si le formualire à été rempli avant de revenir sur la page d'accueil avec le tableau recap des sorties
        if ($outsideForm->isSubmitted() && $outsideForm->isValid()) {
          $outsideData = $outsideForm->getData();

          $em->persist($outsideData);
          $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('sortie/create.html.twig', [
            'outsideForm' => $outsideForm,
        ]);
    }
}