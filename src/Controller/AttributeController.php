<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Attribute;
use App\Form\AttributeType;
use App\Repository\AttributeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AttributeController
 * @package App\Controller\BackOffice
 * @Route("/attributes")
 */
class AttributeController extends AbstractController
{
    /**
     * @Route(name="attribute_manage")
     * @param AttributeRepository $attributeRepository
     * @return Response
     */
    public function manage(AttributeRepository $attributeRepository): Response
    {
        $attributes = $attributeRepository->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render("portfolio/attribute/manage.html.twig", [
            "attributes" => $attributes
        ]);
    }

    /**
     * @Route("/create", name="attribute_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $attribute = new attribute();
        $form = $this->createForm(AttributeType::class, $attribute)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attribute->setUser($this->getUser());
            $this->getDoctrine()->getManager()->persist($attribute);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été ajoutée avec succès !");

            return $this->redirectToRoute("attribute_manage");
        }

        return $this->render("portfolio/attribute/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="attribute_update")
     * @param Attribute $attribute
     * @param Request $request
     * @return Response
     */
    public function update(Attribute $attribute, Request $request): Response
    {
        $form = $this->createForm(AttributeType::class, $attribute)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été modifiée avec succès !");

            return $this->redirectToRoute("attribute_manage");
        }

        return $this->render("portfolio/attribute/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="attribute_delete")
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function delete(Attribute $attribute): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($attribute);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La compétence a été supprimée avec succès !");

        return $this->redirectToRoute("attribute_manage");
    }
}
