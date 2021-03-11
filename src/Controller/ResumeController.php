<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FormationRepository;
use App\Repository\HobbyRepository;
use App\Repository\LanguageRepository;
use App\Repository\ReferenceRepository;
use App\Repository\SkillRepository;
use App\Service\PdfConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ResumeController
 * @package App\Controller
 */
class ResumeController extends AbstractController
{
    private FormationRepository $formationRepository;
    private SkillRepository $skillRepository;
    private ReferenceRepository $referenceRepository;
    private LanguageRepository $languageRepository;
    private HobbyRepository $hobbyRepository;

    /**
     * ResumeController constructor.
     * @param FormationRepository $formationRepository
     * @param SkillRepository $skillRepository
     * @param ReferenceRepository $referenceRepository
     * @param LanguageRepository $languageRepository
     * @param HobbyRepository $hobbyRepository
     */
    public function __construct(
        FormationRepository $formationRepository,
        SkillRepository $skillRepository,
        ReferenceRepository $referenceRepository,
        LanguageRepository $languageRepository,
        HobbyRepository $hobbyRepository
    ) {
        $this->formationRepository = $formationRepository;
        $this->skillRepository = $skillRepository;
        $this->referenceRepository = $referenceRepository;
        $this->languageRepository = $languageRepository;
        $this->hobbyRepository = $hobbyRepository;
    }

    #[Route('/generate', name: 'generate_resume')]
    public function generate(PdfConverter $converter): Response
    {
        $user = $this->getUser();
        $template = '/public/templates/pdf/resume/resume.pdf';
        $converter->generateResume(
            [
                'formations' => $this->formationRepository->findBy(['user' => $user]),
                'skills' => $this->skillRepository->findBy(['user' => $user]),
                'references' => $this->referenceRepository->findBy(['user' => $user]),
                'languages' => $this->languageRepository->findBy(['user' => $user]),
                'hobbies' => $this->hobbyRepository->findBy(['user' => $user])
            ],
            $template
        );
    }
}
