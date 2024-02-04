<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillController extends AbstractController
{
    // This controller show skills with a list //
    #[Route('/skill', name: 'app_skill')]
    public function index(SkillRepository $skillRepository): Response
    {
        $skills = $skillRepository->findAll();

        return $this->render('skill/index.html.twig', [
            'skills' => $skills,
        ]);
    }

    // This controller add skills with a form //
    #[Route('/skill/new', name: 'app_skill_new', methods: ['GET', 'POST'])]
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
            return $this->redirectToRoute('app_skill', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/skill/new.html.twig', [
            'skill' => $skill,
            'formSkill' => $formSkill->createView(),
        ]);
    }

    // This controller update skills with a form //
    #[Route('/skill/{id}/edit', name: 'app_skill_edit', methods: ['GET', 'POST'])]
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

            return $this->redirectToRoute('app_skill', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/skill/new.html.twig', [
            'skill' => $skill,
            'formSkill' => $formSkill->createView(),
        ]);

        return $this->render('/skill/edit.html.twig', [
            'formSkill' => $formSkill->createView(),
        ]);
    }

    // This controller delete skills //
    #[Route('/skill/{id}/delete', name: 'app_skill_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, Skill $skill): Response
    {
        if (!$skill) {
            $this->addFlash(
                'notice',
                'Ton skill n\'existe pas'
            );
            return $this->redirectToRoute('app_skill');
        }

        $entityManager->remove($skill);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Ton skill a bien été supprimé'
        );

        return $this->redirectToRoute('app_skill');
    }
}
