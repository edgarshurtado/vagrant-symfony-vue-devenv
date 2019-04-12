<?php

namespace App\Tests\LearningTests;

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectRepository;

class LearningMockTest extends TestCase{
    public function testMockedFunctionIsCalledOnce(){
        $user = new User();
        $user->setEmail('fake_user@plock.com');

        $userRepository = $this->createMock(ObjectRepository::class);
        $userRepository->expects($this->once())
            ->method('find')
            ->willReturn($user);

        $userFromRepository = $userRepository->find(1);
        $this->assertEquals('fake_user@plock.com', $userFromRepository->getEmail());

    }
     public function testMockedFunctionIsCalledSeveralTimes(){
        $user = new User();
        $user->setEmail('fake_user@plock.com');

        $userRepository = $this->createMock(ObjectRepository::class);
        $userRepository->expects($this->any())
            ->method('find')
            ->willReturn($user);

        $userFromRepository;
        for ($x = 0; $x <= 4; $x++){
            $userFromRepository = $userRepository->find(1);
        }

        $this->assertEquals('fake_user@plock.com', $userFromRepository->getEmail());

     }
}