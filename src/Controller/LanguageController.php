<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Language;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LanguageController
 * @package App\Controller
 * @Route("/languages")
 */
class LanguageController extends AbstractController
{
    /**
     * @Route(name="language_manage")
     * @param LanguageRepository $languageRepository
     * @return Response
     */
    public function manage(LanguageRepository $languageRepository): Response
    {
        $languages = $languageRepository->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render("portfolio/language/manage.html.twig", [
            "languages" => $languages
        ]);
    }

    /**
     * @Route("/create", name="language_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $language = new Language();
        $form = $this->createForm(LanguageType::class, $language)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $language->setUser($this->getUser());
            $this->getDoctrine()->getManager()->persist($language);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été ajoutée avec succès !");

            return $this->redirectToRoute("language_manage");
        }

        return $this->render("portfolio/language/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="language_update")
     * @param Language $language
     * @param Request $request
     * @return Response
     */
    public function update(Language $language, Request $request): Response
    {
        $form = $this->createForm(LanguageType::class, $language)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été modifiée avec succès !");

            return $this->redirectToRoute("language_manage");
        }

        return $this->render("portfolio/language/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="language_delete")
     * @param Language $language
     * @return RedirectResponse
     */
    public function delete(Language $language): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($language);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La compétence a été supprimée avec succès !");

        return $this->redirectToRoute("language_manage");
    }
}
