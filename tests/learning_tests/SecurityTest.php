<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class SecurityTest extends WebTestCase{
    public function testRegisteredUserHasEncryptedPass(){
        $plain_password = '123';
        $argon2i_password = password_hash($plain_password, PASSWORD_ARGON2I);

        $client = static::createClient();
        $test_user = $client->request('POST', '/register', ['email' => 'dont_have@email.com', 'password' => $plain_password])->getResponse();

        $this->assertEquals($argon2i_password, $test_user->getPassword());
    }
}