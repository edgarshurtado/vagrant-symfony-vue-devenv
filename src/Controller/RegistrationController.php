<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class RegistrationController extends AbstractController{
    /**
     * @Route("/register", name="user_registration", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $email = $request->request->get('email');
        $plain_password = $request->request->get('password');

        $user = new User();
        $user->setEmail($email);
        $password = $passwordEncoder->encodePassword($user, $plain_password);
        $user->setPassword($password);

        return $user;
        //$entityManager = $this->getDoctrine()->getManager();
        //$entityManager->persist($user);
        //$entityManager->flush();
    }
}