<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPassHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('stephanievivien@hotmail.com')
            ->setPassword($this->userPassHasher->hashPassword($user, 'User'))
            ->setPhonenumber('0606060606')
            ->setlocalisation('Chémoi')
            ->setDescription('J\'aime le chocolat, le rose, les repas en famille et entre amis, danser, rire, faire du vélo...blablablablablabla')
            ->setJob('Responsable du Bonheur');
        $manager->persist($user);
        $manager->flush();
    }
}
