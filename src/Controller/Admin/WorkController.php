<?php

namespace App\Controller\Admin;

use App\Entity\Work;
use App\Form\WorkType;
use App\Repository\WorkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/work', name: 'app_admin_work_')]
class WorkController extends AbstractController
{
    // This controller show works with a list //
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(WorkRepository $workRepository): Response
    {
        return $this->render('admin/work/index.html.twig', [
            'works' => $workRepository->findAll(),
        ]);
    }
    // This controller add works with a form //
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $work = new Work();
        $formWork = $this->createForm(WorkType::class, $work);

        $formWork->handleRequest($request);

        if ($formWork->isSubmitted() && $formWork->isValid()) {
            $entityManager->persist($work);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ton projet a été enregistré'
            );

            return $this->redirectToRoute('app_admin_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/work/new.html.twig', [
            'work' => $work,
            'formWork' => $formWork->createView(),
        ]);
    }
    // This controller update works with a form //
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Work $work,
        EntityManagerInterface $entityManager
    ): Response {
        $formWork = $this->createForm(WorkType::class, $work);
        $formWork->handleRequest($request);

        if ($formWork->isSubmitted() && $formWork->isValid()) {
            $entityManager->persist($work);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ton projet a été mis à jour'
            );

            return $this->redirectToRoute('app_admin_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/work/edit.html.twig', [
            'work' => $work,
            'formWork' => $formWork->createView(),
        ]);
    }

    // This controller delete works //
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Work $work, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($work);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Ton projet a bien été supprimé'
        );

        return $this->redirectToRoute('app_admin_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
