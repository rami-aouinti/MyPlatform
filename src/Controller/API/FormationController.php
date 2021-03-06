<?php

namespace App\Controller\API;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormationController
 * @package App\Controller\API
 * @Route("/api/formations")
 */
class FormationController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_formations_collection_get")
     * @param FormationRepository $formationRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function collection(FormationRepository $formationRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($formationRepository->findBy([
                'user' => $this->getUser()
            ]), "json", ["groups" => "get"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

}
