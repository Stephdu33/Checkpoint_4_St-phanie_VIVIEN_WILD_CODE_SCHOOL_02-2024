<?php

namespace App\Tests;

use App\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;


class SkillTest extends KernelTestCase
{
    public function getEntity(): Skill
    {
        return (new Skill())
            ->setName('Dynamique')
            ->setCategory('Soft Skills');
    }
    //test 1 valide
    public function testSkillIsValid(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $skill = $this->getEntity();
        $errors = $container->get('validator')->validate($skill);

        $this->assertCount(0, $errors);
    }
    //test 2 non valide
    public function testSkillIsNotValid(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $skill = $this->getEntity()
            ->setName('');

        $errors = $container->get('validator')->validate($skill);

        $this->assertCount(1, $errors);
    }
}
