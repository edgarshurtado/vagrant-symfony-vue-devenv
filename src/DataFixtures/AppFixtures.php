<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        print('Hello from fixtures');
        $user = new User();
        $user->setEmail('robe@fake_domain.com');
        $user->setPassword('test');
        $manager->persist($user);

        $user = new User();
        $user->setEmail('sara@fake_domain.com');
        $user->setPassword('test');
        $manager->persist($user);

        $user = new User();
        $user->setEmail('ana@fake_domain.com');
        $user->setPassword('test');
        $manager->persist($user);

        $user = new User();
        $user->setEmail('javi@fake_domain.com');
        $user->setPassword('test'); 
        $manager->persist($user);

        $manager->flush();
    }
}
