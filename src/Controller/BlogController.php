<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 10/05/2019
 * Time: 01:00
 */

namespace App\Controller;

use App\Service\Greeting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/real-app")
 */
class BlogController extends AbstractController
{
    private $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
    }

    /**
     * @param Request $request
     *
     * @Route("/home/{name}", name="blog_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($name)
    {

        // $service_greetinng = $this->get('app.greeting');

        return $this->render('base.html.twig', ['message' => $this->greeting->hello() . $name]);
    }
}