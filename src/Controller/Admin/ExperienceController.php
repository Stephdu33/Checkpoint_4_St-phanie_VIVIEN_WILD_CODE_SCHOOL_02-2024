<?php

namespace App\Controller\Admin;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// This controller show experiences with a list //
#[Route('admin/experience', name: 'app_admin_experience_')]
class ExperienceController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('admin/experience/index.html.twig', [
            'experiences' => $experienceRepository->findAll(),
        ]);
    }

    // This controller add experiences with a form //
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $experience = new Experience();
        $formExperience = $this->createForm(ExperienceType::class, $experience);
        $formExperience->handleRequest($request);

        if ($formExperience->isSubmitted() && $formExperience->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ta nouvelle expérience professionnelle a été enregistrée'
            );

            return $this->redirectToRoute('app_admin_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/experience/new.html.twig', [
            'experience' => $experience,
            'formExperience' => $formExperience->createView(),
        ]);
    }

    // This controller update experiences with a form //
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        $formExperience = $this->createForm(ExperienceType::class, $experience);
        $formExperience->handleRequest($request);

        if ($formExperience->isSubmitted() && $formExperience->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ton expérience professionnelle a été mise à jour'
            );

            return $this->redirectToRoute('app_admin_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/experience/new.html.twig', [
            'experience' => $experience,
            'formExperience' => $formExperience->createView(),
        ]);
    }

    // This controller delete experiences //
    #[Route('/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($experience);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'Cette expérience professionnelle a bien été supprimée'
        );

        return $this->redirectToRoute('app_admin_experience_index', [], Response::HTTP_SEE_OTHER);
    }
}
