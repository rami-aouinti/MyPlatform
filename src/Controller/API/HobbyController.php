<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\HobbyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class HobbyController
 * @package App\Controller\API
 * @Route("/api/hobbies")
 */
class HobbyController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_hobbies_collection_get")
     * @param HobbyRepository $hobbyRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function collection(HobbyRepository $hobbyRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($hobbyRepository->findBy([
                'user' => $this->getUser()
            ]), "json", ["groups" => "get_hobbies"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
