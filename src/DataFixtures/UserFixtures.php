<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setName('Quentin');
        
        $user2 = new User();
        $user2->setName('Manu');

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}
