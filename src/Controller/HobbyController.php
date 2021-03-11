<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Hobby;
use App\Form\HobbyType;
use App\Repository\HobbyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HobbyController
 * @package App\Controller
 * @Route("/hobbys")
 */
class HobbyController extends AbstractController
{
    /**
     * @Route(name="hobby_manage")
     * @param HobbyRepository $hobbyRepository
     * @return Response
     */
    public function manage(HobbyRepository $hobbyRepository): Response
    {
        $hobbys = $hobbyRepository->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render("portfolio/hobby/manage.html.twig", [
            "hobbys" => $hobbys
        ]);
    }

    /**
     * @Route("/create", name="hobby_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $hobby = new Hobby();
        $form = $this->createForm(HobbyType::class, $hobby)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hobby->setUser($this->getUser());
            $this->getDoctrine()->getManager()->persist($hobby);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été ajoutée avec succès !");

            return $this->redirectToRoute("hobby_manage");
        }

        return $this->render("portfolio/hobby/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="hobby_update")
     * @param Hobby $hobby
     * @param Request $request
     * @return Response
     */
    public function update(Hobby $hobby, Request $request): Response
    {
        $form = $this->createForm(HobbyType::class, $hobby)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été modifiée avec succès !");

            return $this->redirectToRoute("hobby_manage");
        }

        return $this->render("portfolio/hobby/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="hobby_delete")
     * @param Hobby $hobby
     * @return RedirectResponse
     */
    public function delete(Hobby $hobby): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($hobby);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La compétence a été supprimée avec succès !");

        return $this->redirectToRoute("hobby_manage");
    }
}
