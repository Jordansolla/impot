<?php

namespace App\Controller;


use App\Entity\Contribuable;
use App\Repository\ContribuableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(ContribuableRepository $contribuable): Response
    {
        return $this->render('home_page/index.html.twig', [
            'contribuable' => $contribuable->findAll(),
        ]);
    }


}
