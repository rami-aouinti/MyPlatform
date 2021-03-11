<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Profile;
use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\Security\Core\Security;

class ProfileController extends AbstractController
{

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/profile', name: 'profile')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser()->getId());
        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param ProfileRepository $profileRepository
     * @param FileUploader $fileUploader
     * @return Response
     */
    #[Route('profile/{id}/edit', name: 'profile_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user,
        ProfileRepository $profileRepository,
        FileUploader $fileUploader
    ): Response {
        /** @var Profile $profile */
        $profile = $profileRepository->findOneBy([
            'user' => $user
        ]);
        if ($user->getId() != $this->getUser()->getId()) {
            return $this->redirectToRoute('home');
        }
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $profile->setBrochureFilename($brochureFileName);
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'profile' => $profile,
            'form' => $form->createView(),
        ]);
    }

    #[Route('profile/show', name: 'post_show', methods: ['GET'])]
    public function show(): Response
    {
        if (!$this->security->getUser()) {
            $this->redirectToRoute('app_login');
        }
        /** @var User $user */
        $user = $this->security->getUser();
        return $this->render('profile/show.html.twig', [
            'user' => $user
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
