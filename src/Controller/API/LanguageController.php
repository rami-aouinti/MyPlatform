<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class LanguageController
 * @package App\Controller\API
 * @Route("/api/languages")
 */
class LanguageController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="api_languages_collection_get")
     * @param LanguageRepository $languageRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function collection(LanguageRepository $languageRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($languageRepository->findBy([
                'user' => $this->getUser()
            ]), "json", ["groups" => "get_languages"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
