<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ProjectController
 * @package App\Controller\API
 * @Route("/api/projects")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_projects_collection_get")
     * @param ProjectRepository $projectRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function collection(ProjectRepository $projectRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($projectRepository->findBy([
                'user' => $this->getUser()
            ]), "json", ["groups" => "get_projects"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
