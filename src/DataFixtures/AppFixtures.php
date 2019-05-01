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
        $user->setEmail('superadmin@fakemail.com');
        $user->setPassword('test');
        $user_repository->create($user);
    }
}
