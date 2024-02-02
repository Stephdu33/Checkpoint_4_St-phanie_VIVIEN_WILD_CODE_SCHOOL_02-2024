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
    #[Route('/skill', name: 'app_skill')]
    public function index(SkillRepository $skillRepository): Response
    {
        $skills = $skillRepository->findAll();

        return $this->render('skill/index.html.twig', [
            'skills' => $skills,
        ]);
    }

    #[Route('/skill/new', name: 'app_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skill = new Skill();
        $formSkill = $this->createForm(SkillType::class, $skill);

        $formSkill->handleRequest($request);

        if ($formSkill->isSubmitted() && $formSkill->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/skill/new.html.twig', [
            'skill' => $skill,
            'formSkill' => $formSkill->createView(),
        ]);
    }
}
