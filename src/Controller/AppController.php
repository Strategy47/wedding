<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
     *
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function contact() : Response
    {
        return $this->render('contact.html.twig');
    }
}
