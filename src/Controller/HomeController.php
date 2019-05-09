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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


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

        /*
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders = [
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers, $encoders);

        $serializedData = $serializer->serialize($post, 'json',[
            ObjectNormalizer::SKIP_NULL_VALUES  => true
        ]);

        var_dump($serializedData);die();

        */

        return $this->json($post, Response::HTTP_OK, [], [
            ObjectNormalizer::SKIP_NULL_VALUES  => true
        ]);
    }

}