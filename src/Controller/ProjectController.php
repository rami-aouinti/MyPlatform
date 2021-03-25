<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController
 * @package App\Controller\BackOffice
 * @Route("/projects")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route(name="project_manage")
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function manage(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render("portfolio/project/manage.html.twig", [
            "projects" => $projects
        ]);
    }

    /**
     * @Route("/create", name="project_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $project = new project();
        $form = $this->createForm(ProjectType::class, $project)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setUser($this->getUser());
            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été ajoutée avec succès !");

            return $this->redirectToRoute("project_manage");
        }

        return $this->render("portfolio/project/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="project_update")
     * @param Project $project
     * @param Request $request
     * @return Response
     */
    public function update(Project $project, Request $request): Response
    {
        $form = $this->createForm(ProjectType::class, $project)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été modifiée avec succès !");

            return $this->redirectToRoute("project_manage");
        }

        return $this->render("portfolio/project/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="project_delete")
     * @param Project $project
     * @return RedirectResponse
     */
    public function delete(Project $project): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($project);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La compétence a été supprimée avec succès !");

        return $this->redirectToRoute("project_manage");
    }
}
