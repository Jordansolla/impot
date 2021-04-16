<?php

namespace App\Controller;

use App\Entity\Child;
use App\form\ChildType;
use App\Repository\ChildRepository;
use App\Repository\ContribuableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContribuableController extends AbstractController
{
    #[Route('/contribuable', name: 'contribuable')]
    public function index(): Response
    {
        return $this->render('contribuable/index.html.twig', [
            'controller_name' => 'ContribuableController',
        ]);
    }

    #[Route('/contribuable/profile', name: 'contribuable.profile')]
    public function profile()
    {
        dd($this->getUser());

        return $this->render('contribuable/child.html.twig', [
        ]);
    }

    #[Route('/contribuable/child', name: 'contribuable.child')]
    public function indexChild(ChildRepository $childRepo, ContribuableRepository $contribuableRepo, Request $request)
    {

       $user = $this->getUser(); // appel l'user connecter

       $contribuable = $contribuableRepo->findOneBy([
           'user' => $user
       ]);
       $childId = $childRepo->findBy([
           'contribuable' => $contribuable->getId()
       ]);

        $child = new Child();

        $child->setContribuable($contribuable);

        $form = $this->createForm(ChildType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($child);
            $entityManager->flush();

            return $this->redirectToRoute('contribuable.child');
        }

        return $this->render('contribuable/child.html.twig', [
            'form' => $form->createView(),
            'childs' => $childId
        ]);
    }

    #[Route('/contribubale/child/edit-{child}', name: 'contribuable.child.edit')]
    public function edit(Request $request, Child $child): Response
    {
        $this->getUser();
        $form = $this->createForm(ChildType::class, $child);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contribuable.child');
        }

        return $this->render('contribuable/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contribuable/delete/{child}', name: 'contribuable.child.delete', methods: ['DELETE'])]
    public function delete(Request $request,Child $child)
    {
        if ($this->isCsrfTokenValid('delete'.$child->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($child);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contribuable.child');
    }
}
