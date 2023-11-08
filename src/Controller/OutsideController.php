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
    #[Route('/outside/place', name: 'app_outside_getId')]
    public function get(Request $request)
    {
        $session = $request->getSession(); // Récupération de la session associé à la demande
        $placeId = $request->request->get('placeId'); // Extraction de la valeur placId de la requête, valeur soumise par le  formualire
        $session->set('place', $placeId); // Permet de stocker la valeur placeId dans la session de l'utilisateur concernée

        return new Response('');
    }

    #[Route('/create_outside', name: 'app_create_outside', methods: ['GET', 'POST'])]
    public function index(
        PlaceRepository $placeRepository, // Paramètre permettant d'accéder à Place
        CityRepository $cityRepository, // Paramètre permettant d'accéder à City
        StatutRepository $statutRepository, // Paramètre permettant d'accéder à Statut
        Request $request, // Paramètre permettant d'accéder aux données
        EntityManagerInterface $em //Parmètre permettant une bonne gestion des entit
    ): Response
    {
        // Recuperation de toutes les proprietes de la table city
        $citys = $cityRepository->findAll();
        // Recuperation du Statut CREATE via la table STATUT
        $statutCrea = $statutRepository->findByWording(Statut::CREEE);
        // Recuperation du Statut PUBLIER via la table STATUT
        $statutPublish = $statutRepository->findByWording(Statut::PUBLIER);
        // Recuperation des infos de la session
        $session = $request->getSession();
        // Creation d'une sortie
        $outside = new Outside();
        // Attribution d'un promotteur à une sortie
        $outside->setPromoter($this->getUser());

        if ($request->request->has('register')) {
            $outside->setStatut($statutCrea);
        }

        if ($request->request->has('publish')) {
            $outside->setStatut($statutPublish);
        }

        // Création d'un formulaire de sortie
        $form_sortie = $this->createForm(OutsideType::class, $outside);
        // Permet de récupérer les données et de les associer au formualire de sortie
        $form_sortie->handleRequest($request);

        // On check si le formualire à été rempli avant d'être envoyé
        if ($form_sortie->isSubmitted() && $form_sortie->isValid()) {
            $placeId = $session->get('place');
            if ($placeId) {
                $place = $placeRepository->find($placeId);
                $outside->setPlace($place);
            } else {
                throw new \Exception('Place is null');
            }

            $em->persist($outside);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('sortie/create.html.twig', [
            'form_sortie' => $form_sortie,
            'citys' => $citys,
            ''
        ]);
    }
}