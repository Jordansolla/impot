<?php

namespace App\Controller;

use App\Entity\Bareme;
use App\Entity\Tranche;
use App\form\BaremeType;
use App\form\TrancheType;
use App\Repository\BaremeRepository;
use App\Repository\TrancheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BaremeController extends AbstractController
{
    #[Route('/bareme', name: 'bareme')]
    public function index(BaremeRepository $baremeRepo): Response
    {
        return $this->render('bareme/index.html.twig', [
            'baremes' => $baremeRepo->findAll(),

        ]);
    }

    #[Route('/bareme/new', name: 'bareme_create')]
    public function new(Request $request): Response
    {

        $bareme = new Bareme();
        $formBareme = $this->createForm(BaremeType::class, $bareme);
        $formBareme->handleRequest($request);

        if ($formBareme->isSubmitted() && $formBareme->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bareme);
            $entityManager->flush();

            return $this->redirectToRoute('bareme');
        }
        return $this->render('bareme/new.html.twig', [
            'formBareme' => $formBareme->createView(),

        ]);

    }

    #[Route('/bareme/{bareme}', name: 'bareme_tranche')]
    public function indexTranche(Bareme $bareme): Response
    {
//        dd($bareme);
        return $this->render('bareme/show.html.twig', [
            'bareme' => $bareme
        ]);
    }

    #[Route('/bareme/{bareme}/edit', name: 'bareme.edit')]
    public function edit(Request $request, Bareme $bareme, TrancheRepository $trancheRepo): Response
    {
       $tranches =  $trancheRepo->findBy(['bareme' => $bareme]);
//        dd($test);

        $formBareme = $this->createForm(BaremeType::class, $bareme);
        $formBareme->handleRequest($request);


            $i = 1;
            $form = [];

        foreach ($tranches as $tranche)
        {
            $trancheNum[$i] = $this->createForm(TrancheType::class, $tranche) ;

            $form[] = $trancheNum[$i]->createView();
            $trancheNum[$i]->handleRequest($request);

            if ($trancheNum[$i]->isSubmitted() && $trancheNum[$i]->isValid())
            {
                $this->getDoctrine()->getManager()->persist($tranche);
            }
            $i++;
        }

        if ($formBareme->isSubmitted() && $formBareme->isValid())
        {
            $this->getDoctrine()->getManager()->persist($bareme);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bareme');
        }


        return $this->render('bareme/edit.html.twig', [
            'formBareme' => $formBareme->createView(),
            'form' => $form,
            'bareme' => $bareme

        ]);
    }

    #[Route('/bareme/{bareme}/delete', name: 'bareme.delete')]
    public function delete(Bareme $bareme, TrancheRepository $trancheRepo)
    {

        $tranches = $trancheRepo->findByBareme($bareme->getId());

        $em = $this->getDoctrine()->getManager();
        foreach ($tranches as $tranche)
        {
            $bareme->removeTranch($tranche);
            $em->remove($tranche);
        }
        $em->remove($bareme);
        $em->flush();

        return $this->redirectToRoute('bareme');
    }
}
