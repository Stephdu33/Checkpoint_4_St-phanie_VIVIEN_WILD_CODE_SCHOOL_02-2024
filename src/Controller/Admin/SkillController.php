<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/skill', name: 'app_admin_skill_')]
class SkillController extends AbstractController
{
    // This controller show skills with a list //
    #[Route('/', name: 'index')]
    public function index(
        SkillRepository $skillRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $pagination = $paginator->paginate(
            $skillRepository->queryFindAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('admin/skill/index.html.twig', [
            'skills' => $pagination,
        ]);
    }

    // This controller add skills with a form //
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skill = new Skill();
        $formSkill = $this->createForm(SkillType::class, $skill);

        $formSkill->handleRequest($request);

        if ($formSkill->isSubmitted() && $formSkill->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ton skill a été enregistré'
            );
            return $this->redirectToRoute('app_admin_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/skill/new.html.twig', [
            'skill' => $skill,
            'formSkill' => $formSkill->createView(),
        ]);
    }

    // This controller update skills with a form //
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Skill $skill,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $formSkill = $this->createForm(SkillType::class, $skill);
        $formSkill->handleRequest($request);
        if ($formSkill->isSubmitted() && $formSkill->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Ton skill a été mis à jour'
            );

            return $this->redirectToRoute('app_admin_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/skill/new.html.twig', [
            'skill' => $skill,
            'formSkill' => $formSkill->createView(),
        ]);
    }

    // This controller delete skills //
    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, Skill $skill): Response
    {
        $entityManager->remove($skill);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Ton skill a bien été supprimé'
        );

        return $this->redirectToRoute('app_admin_skill_index');
    }
}
