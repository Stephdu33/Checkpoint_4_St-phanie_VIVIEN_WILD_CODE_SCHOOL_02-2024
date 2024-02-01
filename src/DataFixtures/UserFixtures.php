<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('moi@moi.com')
            ->setPassword('123456')
            ->setPhonenumber('0606060606')
            ->setlocalisation('Chémoi')
            ->setDescription('J\'aime le chocolat, le rose, les repas en famille et entre amis, danser, rire, faire du vélo...blablablablablabla')
            ->setRoles(['ROLE_ADMIN'])
            ->setJob('Responsable du Bonheur');
        $manager->persist($user);
        $manager->flush();
    }
}
