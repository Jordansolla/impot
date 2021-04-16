<?php

namespace App\Controller;

use App\Entity\Contribuable;

use App\Entity\User;
use App\form\ContribuableType;
use App\form\UserContriType;
use App\Repository\ContribuableRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GestionnaireController extends AbstractController
{
    #[Route('/gestionnaire', name: 'gestionnaire')]
    public function index(Request $request, UserRepository $userRepo, ContribuableRepository $contribuableRepo, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $users = $userRepo->findAll();
        $contribuables = $contribuableRepo->findAll();

        $user = new User();
        $contribuable = new Contribuable();

        $user->setContribuable($contribuable);

        $form = $this->createForm(UserContriType::class, $user);
        $formContri = $this->createForm(ContribuableType::class, $contribuable);

        $form->handleRequest($request);
        $formContri->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->persist($contribuable);
            $entityManager->flush();

            return $this->redirectToRoute('gestionnaire');
        }


        return $this->render('gestionnaire/index.html.twig', [
            'users' => $users,
            'gestionnaires' => $contribuables,

            'form' => $form->createView(),
            'formContri' => $formContri->createView(),
        ]);
    }

    #[Route('/contribubale/{user}/{contribuable}/edit', name: 'contribuable.edit')]
    public function edit(Request $request, User $user, Contribuable $contribuable,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserContriType::class, $user);
        $formContri = $this->createForm(ContribuableType::class, $contribuable);

        $form->handleRequest($request);
        $formContri->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestionnaire');
        }

        return $this->render('gestionnaire/edit.html.twig', [
            'user' => $user,
            'contribuable' => $contribuable,

            'form' => $form->createView(),
            'formContri' => $formContri->createView(),
        ]);
    }

    #[Route('/contribuable/{user}/{contribuable}/delete', name: 'contribuable.delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user, Contribuable $contribuable)
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->remove($contribuable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gestionnaire');
    }
}
