<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Repository\UserRepository;

class SecurityTest extends KernelTestCase{
    public function testRegisteredUserHasEncryptedPass(){
        self::bootKernel();

        $plain_password = 'test';
        $user = new User();
        $user->setEmail('fake_user2@fake_domain.com');
        $user->setPassword($plain_password);

        $container = self::$kernel->getContainer();
        $entityManager = $container->get('doctrine')->getManager();

        $user_repository = $entityManager->getRepository(User::class);
        $user_repository->create($user);

        $userFromDB = $user_repository->findByEmail('fake_user2@fake_domain.com')->getPassword(); 
        $pass = explode('$', $userFromDB);
        $this->assertEquals($pass[1], 'argon2i');
    }
}