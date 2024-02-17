<?php

namespace App\Controller\Admin;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// This controller show educations with a list //
#[Route('/admin/education', name: 'app_admin_education_')]
class EducationController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EducationRepository $educationRepository): Response
    {
        return $this->render('admin/education/index.html.twig', [
            'educations' => $educationRepository->findAll(),
        ]);
    }

    // This controller add educations with a form //
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $education = new Education();
        $formEducation = $this->createForm(EducationType::class, $education);
        $formEducation->handleRequest($request);

        if ($formEducation->isSubmitted() && $formEducation->isValid()) {
            $entityManager->persist($education);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ta nouvelle formation a été enregistrée'
            );

            return $this->redirectToRoute('app_admin_education_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/education/new.html.twig', [
            'education' => $education,
            'formEducation' => $formEducation->createView(),
        ]);
    }

    // This controller update educations //
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Education $education, EntityManagerInterface $entityManager): Response
    {
        $formEducation = $this->createForm(EducationType::class, $education);
        $formEducation->handleRequest($request);

        if ($formEducation->isSubmitted() && $formEducation->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ta formation a été mise à jour'
            );


            return $this->redirectToRoute('app_admin_education_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/education/new.html.twig', [
            'education' => $education,
            'formEducation' => $formEducation->createView(),
        ]);
    }

    // This controller delete educations //
    #[Route('/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Education $education, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($education);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'Cette formation a bien été supprimée'
        );


        return $this->redirectToRoute('app_admin_education_index', [], Response::HTTP_SEE_OTHER);
    }
}
