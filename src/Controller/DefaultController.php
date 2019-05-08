<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 08/05/2019
 * Time: 14:56
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Event\CommentPublishedEvent;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{


    /**
     * @param Request $request
     * @param Article $article
     * @param ObjectManager $manager
     * @param EventDispatcher $dispatcher
     *
     * @Route("/article_comment", name="article_comment_view")
     *
     * @return Response
     */
    public function viewAction(Request $request, ObjectManager $manager, EventDispatcherInterface $dispatcher)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $this->getDoctrine()->getConnection();

            /* La transaction permettra d'invalider la peristence de $comment
                dès qu'une instruction comprise entre le "beginTransaction" et le "em->commit" buggue !

                Si une instruction entre ces deux instructions plante, alors Doctrine effectue un Rollback !
            */
            $em->getConnection()->beginTransaction();

            $manager->persist($comment);
            $manager->flush();

            /* Générer l'évenement et le propager dans l'application : */
            $event = new CommentPublishedEvent($comment);
            $dispatcher->dispatch(CommentPublishedEvent::NAME, $event);

            $em->commit();

        }

        return $this->render('default/view.html.twig', [
            'form' => $form->createView()
        ]);
    }

}