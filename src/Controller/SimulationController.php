<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimulationController extends AbstractController
{
    #[Route('/simulation', name: 'simulation')]
    public function index(): Response
    {
        return $this->render('simulation/index.html.twig', [
            'controller_name' => 'SimulationController',
        ]);
    }
}
