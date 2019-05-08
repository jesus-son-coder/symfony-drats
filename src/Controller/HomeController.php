<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 09/05/2019
 * Time: 01:00
 */

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $post = new Post();

        $post->setTitle('Overseas Media');
        $post->setContent('Is trash');

        return $this->json($post);
    }

}