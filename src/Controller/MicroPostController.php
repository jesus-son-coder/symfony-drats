<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 11/05/2019
 * Time: 08:48
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Repository\MicroPostRepository;

/**
 * @Route("/micro-post")
 */
class MicroPostController extends AbstractController
{
    private $microPostRepository;

    public function __construct(MicroPostRepository $microPostRepository)
    {
        $this->microPostRepository = $microPostRepository;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index()
    {
        return $this->render('micro-post/index.html.twig',[
            'posts' => $this->microPostRepository->findAll()
        ]);
    }
}