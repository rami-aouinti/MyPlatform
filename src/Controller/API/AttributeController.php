<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\AttributeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class AttributeController
 * @package App\Controller\API
 * @Route("/api/attributes")
 */
class AttributeController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_attributes_collection_get")
     * @param AttributeRepository $attributeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function collection(AttributeRepository $attributeRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($attributeRepository->findBy([
                'user' => $this->getUser()
            ]), "json", ["groups" => "get_attributes"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
