<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\WorkRepository;
use App\Repository\ImageRepository;
use App\Repository\SkillRepository;
use App\Repository\ContactRepository;
use App\Repository\LanguageRepository;
use App\Repository\EducationRepository;
use App\Repository\ExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        UserRepository $userRepository,
        WorkRepository $workRepository,
        SkillRepository $skillRepository,
        LanguageRepository $languageRepository,
        EducationRepository $educationRepository,
        ExperienceRepository $experienceRepository,
        ContactRepository $contactRepository,
    ): Response {
        return $this->render('home/index.html.twig', [
            // Passer la variable 'users' à la vue Twig
            'users' => $userRepository->findAll(),
            'works' => $workRepository->findAll(),
            'skills' => $skillRepository->findAll(),
            'languages' => $languageRepository->findAll(),
            'educations' => $educationRepository->findAll(),
            'experiences' => $experienceRepository->findAll(),
            'contact' => $contactRepository->findAll(),
        ]);
    }
}
