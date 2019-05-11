<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 11/05/2019
 * Time: 08:48
 */

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
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
    private $formFactory;
    private $entityManager;

    public function __construct(MicroPostRepository $microPostRepository, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {
        $this->microPostRepository = $microPostRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
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

    /**
     * @Route("/add", name="micro_post_add")
     */
    public function add(Request $request)
    {
        $micropost = new MicroPost();
        $micropost->setTime(new \DateTime());

        $form = $this->formFactory->create(MicroPostType::class, $micropost);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $this->entityManager->persist($micropost);
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="micro_post_post")
     */
    public function post(MicroPost $post)
    {
        // Du coup nous n'avons plus besoin d'utiliser explicitement le Repository !!
        // $post = $this->microPostRepository->find($post->getId());

        return $this->render('micro-post/post.html.twig',[
            'post' => $post
        ]);
    }
}