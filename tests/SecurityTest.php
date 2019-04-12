<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Repository\UserRepository;

class SecurityTest extends KernelTestCase{
    public function testRegisteredUserHasEncryptedPass(){

        $user = new User();
        $user->setEmail('fake_user2@plock.com');
        $plain_password = 'test';
        $user->setPassword($plain_password);

        self::bootKernel();
        $container = self::$kernel->getContainer();
        $entityManager = $container->get('doctrine')->getManager();

        $user_repository = $entityManager->getRepository(User::class);
        $user_repository->create($user);

        $userFromDB = $user_repository->findByEmail('fake_user2@plock.com')->getPassword(); 
        $pass_encription = explode('$', $userFromDB)[1];
        $this->assertEquals($pass_encription, 'argon2i');
    }
}