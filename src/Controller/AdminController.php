<?php

namespace App\Controller;

use App\Entity\Gestionnaire;
use App\Entity\User;
use App\form\GestionnaireType;
use App\form\UserType;
use App\Repository\GestionnaireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/admin', name: 'admin.')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, UserRepository $userRepo, GestionnaireRepository $gestionnaireRepo, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $users = $userRepo->findAll();
        $gestionnaires = $gestionnaireRepo->findAll();

        $user = new User();
        $gestionnaire = new Gestionnaire();

        $user->setGestionnaire($gestionnaire);

        $form = $this->createForm(UserType::class, $user);
        $formGest = $this->createForm(GestionnaireType::class, $gestionnaire);

        $form->handleRequest($request);
        $formGest->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($user);
                $entityManager->persist($gestionnaire);
                $entityManager->flush();

                return $this->redirectToRoute('admin.index');
        }


        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'gestionnaires' => $gestionnaires,

            'form' => $form->createView(),
            'formGest' => $formGest->createView(),
        ]);
    }

    #[Route('/gestionnaire/{user}/{gestionnaire}/edit', name: 'gestionnaire.edit')]
    public function edit(Request $request, User $user, Gestionnaire $gestionnaire,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $formGest = $this->createForm(GestionnaireType::class, $gestionnaire);

        $form->handleRequest($request);
        $formGest->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/edit.html.twig', [
            'user' => $user,
            'gestionnaire' => $gestionnaire,

            'form' => $form->createView(),
            'formGest' => $formGest->createView(),
        ]);
    }

    #[Route('/gestionnaire/{user}/{gestionnaire}/delete', name: 'gestionnaire.delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user, Gestionnaire $gestionnaire)
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->remove($gestionnaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.index');
    }

}
