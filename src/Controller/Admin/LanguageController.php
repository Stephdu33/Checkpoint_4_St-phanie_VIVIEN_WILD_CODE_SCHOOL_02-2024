<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// This controller show languages with a list //
#[Route('/admin/language', name: 'app_admin_language_')]
class LanguageController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(LanguageRepository $languageRepository): Response
    {
        return $this->render('admin/language/index.html.twig', [
            'languages' => $languageRepository->findAll(),
        ]);
    }

    // This controller add languages with a form //
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $language = new Language();
        $formLanguage = $this->createForm(LanguageType::class, $language);
        $formLanguage->handleRequest($request);

        if ($formLanguage->isSubmitted() && $formLanguage->isValid()) {
            $entityManager->persist($language);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ta langue étrangère a été enregistrée'
            );

            return $this->redirectToRoute('app_admin_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/language/new.html.twig', [
            'language' => $language,
            'formLanguage' => $formLanguage->createView(),
        ]);
    }

    // This controller update languages with a form //
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Language $language,
        EntityManagerInterface $entityManager
    ): Response {
        $formLanguage = $this->createForm(LanguageType::class, $language);
        $formLanguage->handleRequest($request);

        if ($formLanguage->isSubmitted() && $formLanguage->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ta langue a été mise à jour'
            );

            return $this->redirectToRoute('app_admin_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/language/new.html.twig', [
            'language' => $language,
            'formLanguage' => $formLanguage->createView(),
        ]);
    }

    // This controller delete languages //
    #[Route('/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Language $language, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($language);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'Ta langue a bien été supprimée'
        );

        return $this->redirectToRoute('app_admin_language_index', [], Response::HTTP_SEE_OTHER);
    }
}
