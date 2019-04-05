<?php

namespace App\Tests\InMemoryDbTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Tests\DatabasePrimer;

class InMemoryDbTest extends KernelTestCase{

     public function testDbPersistence(){
        self::bootKernel();

        $user = new User();
        $user->setEmail('fake_user@fake_domain.com');
        $user->setPassword('test');

        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $user_repository = $entityManager->getRepository(User::class);
        $userFromDB = $user_repository->findByEmail('fake_user@fake_domain.com'); 
        $this->assertEquals('fake_user@fake_domain.com', $userFromDB->getEmail());
     }

     public function testFixturesLoad(){
        self::bootKernel();
        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
        $user_repository = $entityManager->getRepository(User::class);
        $userFromDB = $user_repository->findByEmail('robe@fake_domain.com'); 
        $this->assertEquals('robe@fake_domain.com', $userFromDB->getEmail());
     }
}