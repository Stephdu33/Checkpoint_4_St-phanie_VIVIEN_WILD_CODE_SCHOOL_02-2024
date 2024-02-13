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

#[Route('admin/education', name: 'app_admin_education_')]
class EducationController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EducationRepository $educationRepository): Response
    {
        return $this->render('admin/education/index.html.twig', [
            'education' => $educationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $education = new Education();
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($education);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_education_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/education/new.html.twig', [
            'education' => $education,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Education $education): Response
    {
        return $this->render('admin/education/show.html.twig', [
            'education' => $education,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Education $education, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_education_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/education/edit.html.twig', [
            'education' => $education,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Education $education, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $education->getId(), $request->request->get('_token'))) {
            $entityManager->remove($education);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_education_index', [], Response::HTTP_SEE_OTHER);
    }
}
