<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Repository\UserRepository;

class SecurityTest extends KernelTestCase{
    public function testRegisteredUserHasEncryptedPass(){
        $plain_password = '123';
        $argon2i_password = password_hash($plain_password, PASSWORD_ARGON2I);

        self::bootKernel();

        $user = new User();
        $user->setEmail('fake_user2@fake_domain.com');
        $user->setPassword('test');

        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
        $user_repository = $entityManager->getRepository(User::class);
        $user_repository->create($user);
        $userFromDB = $user_repository->findByEmail('fake_user2@fake_domain.com'); 

        $this->assertEquals($argon2i_password, $userFromDB->getPassword());
    }
}