<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController{
    /**
     * @Route("/")
     */
    public function index(){
        $apppath = __DIR__.'/../../public/index.html';
        $response = new Response();

        $response->setContent(file_get_contents($apppath));
        $response->headers->set('Content-Type', 'text/html');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }

    /**
     * @Route("/login", name="login_page", methods={"GET"})
     */
    public function login_page(){
        $apppath = __DIR__.'/../../public/index.html';
        $response = new Response();

        $response->setContent('hola');
        $response->headers->set('Content-Type', 'text/html');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }
}
?>