<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skill;


class SkillFixtures extends Fixture
{
    public const SKILLS = [
        'Hard Skills' => ['PHP', 'SYMFONY', 'MySQL', 'Twig', 'HTML', 'CSS', 'API', 'Git'],
        'Soft Skills' => ['Esprit d’équipe', 'Rigueur', 'Sens de l’écoute', 'Curiosité', 'Dynamisme'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SKILLS as $skillCategory => $skills) {
            foreach ($skills as $skillName) {
                $skill = new Skill();
                $skill
                    ->setName($skillName)
                    ->setCategory($skillCategory);
                $manager->persist($skill);
            }
        }
        $manager->flush();
    }
}
