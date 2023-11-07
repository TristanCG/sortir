<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanneauControleController extends AbstractController
{
    #[Route('/pc', name: 'app_panneau_controle')]
    public function index(): Response
    {
        return $this->render('panneau_controle/index.html.twig', [
            'controller_name' => 'PanneauControleController',
        ]);
    }
}
