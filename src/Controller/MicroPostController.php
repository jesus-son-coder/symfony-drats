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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\MicroPostRepository;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route("/micro-post")
 */
class MicroPostController extends AbstractController
{
    private $microPostRepository;
    private $formFactory;
    private $entityManager;
    private $flashBag;
    private $authorizationChecker;

    public function __construct(MicroPostRepository $microPostRepository, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->microPostRepository = $microPostRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index()
    {
        return $this->render('micro-post/index.html.twig',[
            'posts' => $this->microPostRepository->findBy([], ['time' => 'DESC'])
        ]);
    }

    /**
     * @Route("/edit/{id}", name="micro_post_edit")
     * @Security("is_granted('edit', microPost)", message="Access denied")
     */
    public function edit(MicroPost $microPost, Request $request)
    {
        $form = $this->formFactory->create(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $microPost->setTime(new \DateTime());

            $this->entityManager->persist($microPost);
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $microPost
        ]);
    }


    /**
     * @Route("/delete/{id}", name="micro_post_delete")
     * @Security("is_granted('delete', microPost)", message="Access denied")
     */
    public function delete(MicroPost $microPost)
    {
        $this->entityManager->remove($microPost);
        $this->entityManager->flush();

        $this->flashBag->add('notice', "Micro post deleted !");

        return $this->redirectToRoute('micro_post_index');
    }


    /**
     * @Route("/add", name="micro_post_add")
     * @Security("is_granted('ROLE_USER')")
     */
    public function add(Request $request)
    {
        $user = $this->getUser();

        $micropost = new MicroPost();
        $micropost->setTime(new \DateTime());
        $micropost->setUser($user);

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
     * Display all the Posts from a certain USer.
     * @Route("/user/{username}", name="micro_post_user")
     */
    public function userPosts(User $userWithPosts)
    {
        return $this->render('micro-post/index.html.twig',[
            'posts' => $this->microPostRepository->findBy(
                ['user' => $userWithPosts],
                ['time' => 'DESC'])
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