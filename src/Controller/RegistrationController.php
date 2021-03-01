<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Security\WebAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * @Route("/registration", name="app_registration")
 */
class RegistrationController extends AbstractController
{
    public function __invoke(
        Request $request,
        GuardAuthenticatorHandler $guardAuthenticatorHandler,
        WebAuthenticator $webAuthenticator
    ): Response {
        $user = new User();

        $form = $this->createForm(UserType::class, $user)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();

            return $guardAuthenticatorHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $webAuthenticator,
                "main"
            );
        }

        return $this->render("security/registration.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
