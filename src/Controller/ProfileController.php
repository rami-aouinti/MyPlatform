<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser()->getId());
        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('profile/{id}/edit', name: 'profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        if ($this->getUser()->getId() != $user->getId()) {
            return $this->redirectToRoute('home');
        }
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('profile/{id}', name: 'profile_delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_index');
    }
}
