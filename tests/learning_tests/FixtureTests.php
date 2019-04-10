<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Tests\DatabasePrimer;

class FixtureTests extends KernelTestCase{

     public function testFixturesLoad(){
        self::bootKernel();
        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
        $user_repository = $entityManager->getRepository(User::class);
        $userFromDB = $user_repository->findByEmail('robe@fake_domain.com'); 
        $this->assertEquals('robe@fake_domain.com', $userFromDB->getEmail());
     }
}