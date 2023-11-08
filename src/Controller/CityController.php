<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    #[Route('/city', name: 'app_city')]
    public function list(CityRepository $cityRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $city = $cityRepository->findAll();
        $cityForm = $this->createForm(CityType::class);

        $cityForm->handleRequest($request);

        if($cityForm->isSubmitted() && $cityForm->isValid()){
            $cityData = $cityForm->getData();

            $entityManager->persist($cityData);
            $entityManager->flush();

            return $this->redirectToRoute('app_city');
        }

        return $this->render('city/index.html.twig', [
            'citys' => $city,
            'cityForm' => $cityForm->createView(),
        ]);
    }


    #[Route('/city/{id}/edit', name: 'city_edite', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $city = $entityManager->getRepository(City::class)->find($id);

        if(!$city){
            throw $this->createNotFoundException('City introuvable');
        }

        $cityForm = $this->createForm(CityType::class, $city);
        $cityForm->handleRequest($request);

        if ($cityForm->isSubmitted() && $cityForm->isValid()){
            $entityManager->flush();;

            return $this->redirectToRoute('app_city');
        }

        return $this->render('city/edit.html.twig', [
            'cityForm' => $cityForm->createView(),
        ]);
    }


    #[Route('/city/{id}/delete', name: 'city_delete', methods: ['GET'])]
    public function delete(int $id, CityRepository $cityRepository, EntityManagerInterface $entityManager): Response
    {
        $city = $cityRepository->find($id);

        if($city){
            $entityManager->remove($city);
            $entityManager->flush();
        } else {
            return $this->redirectToRoute('app_city');
        }

        return $this->redirectToRoute('app_city');
    }
}
