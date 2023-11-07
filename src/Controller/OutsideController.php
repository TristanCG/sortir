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
        $session = $request->getSession();
        $placeId = $request->request->get('placeId');
        $session->set('place', $placeId);

        return new Response('');
    }

    #[Route('/outside/create', name: 'app_create_outside', methods: ['GET', 'POST'])]
    public function index(
        PlaceRepository $placeRepository,
        CityRepository $cityRepository,
        StatutRepository $statutRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $citys = $cityRepository->findAll();
        $statutCrea = $statutRepository->findOneBy(['name' => Statut::class]);
        $statutPublish = $statutRepository->findOneBy(['name' => Statut::class]);
        $session = $request->getSession();
        $outside = new Outside();
        $outside->setPromoter($this->getUser());
        $outside->setCampus($this->getUser()->getCampus());

        if ($request->request->has('register')) {
            $outside->setStatut($statutCrea);
        }

        if ($request->request->has('publish')) {
            $outside->setStatut($statutPublish);
        }

        $form_sortie = $this->createForm(OutsideType::class, $outside);
        $form_sortie->handleRequest($request);

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
        ]);
    }
}