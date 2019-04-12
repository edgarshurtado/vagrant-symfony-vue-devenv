<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user_repository = $manager->getRepository(User::class);

        $user = new User();
        $user->setEmail('robe@plock.com');
        $user->setPassword('test');
        $user_repository->create($user);

        $user = new User();
        $user->setEmail('sara@plock.com');
        $user->setPassword('test');
        $user_repository->create($user);

        $user = new User();
        $user->setEmail('ana@plock.com');
        $user->setPassword('test');
        $user_repository->create($user);

        $user = new User();
        $user->setEmail('javi@plock.com');
        $user->setPassword('test'); 
        $manager->persist($user);

    }
}
