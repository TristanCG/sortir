<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Form\OutsideType;
use App\Repository\CityRepository;
use App\Repository\PlaceRepository;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutsideController extends AbstractController
{

    #[Route('/outside/place', name: 'app_outside_getId')]
    public function get(Request $request)
    {
        $session = $request->getSession();
        $placeId = $request->request-->get('placeId');
        $session->set('place', $placeId);

        return new Response('');
    }

    #[Route('/outside/create', name: 'app_create_outside',methods: ['GET','POST'])]
    public function index(PlaceRepository $placeRepository,
                          CityRepository $cityRepository,
                          StatutRepository $statutRepository,
                          Request $request,
                          EntityManagerInterface $em
    ): Response
    {
        $citys = $cityRepository->findAll();
        $statutCrea = $statutRepository->findBy(Statut::CREA);
        $statutPublish = $statutRepository->findBy(Statut::PUBLISH);
        $session = $request->getSession();
        $outside = new Outside();
        $outside->setPromoter($this->getUser());
        $outside->setCampus($this->getUser()->getCampus());

        if ($request->request->has('register'))
        {
            $outside->setStatut($statutCrea);
        }

        if ($request->request->has('publish'))
        {
            $outside->setStatut($statutPublish);
        }

        $form_sortie = $this->createForm(OutsideType::class,$outside);
        $form_sortie->handleRequest($request);

        if ()


    }

    {
        return $this->render('sortie/create.html.twig',
            [
            ]);
    }
}
