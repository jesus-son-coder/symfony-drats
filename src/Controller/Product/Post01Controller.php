<?php

namespace App\Controller\Product;

use App\Entity\Product\Post01;
use App\Form\Product\Post011Type;
use App\Form\Product\Post011_02Type;
use App\Repository\Product\Post01Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/post01")
 */
class Post01Controller extends AbstractController
{
    /**
     * @Route("/", name="post01_index", methods={"GET"})
     */
    public function index(Post01Repository $post01Repository): Response
    {
        return $this->render('product/post01/index.html.twig', [
            'post01s' => $post01Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post01_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post01 = new Post01();
        $form = $this->createForm(Post011Type::class, $post01);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post01);
            $entityManager->flush();

            return $this->redirectToRoute('post01_index');
        }

        return $this->render('product/post01/new.html.twig', [
            'post01' => $post01,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post01_show", methods={"GET"})
     */
    public function show(Post01 $post01): Response
    {
        return $this->render('product/post01/show.html.twig', [
            'post01' => $post01,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post01_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Post01 $post01): Response
    {
        $form = $this->createForm(Post011Type::class, $post01);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post01_index', [
                'id' => $post01->getId(),
            ]);
        }

        return $this->render('product/post01/edit.html.twig', [
            'post01' => $post01,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post01_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Post01 $post01): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post01->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post01);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post01_index');
    }




    /**
     * @Route("/pos01t02/new", name="post01_02_new", methods={"GET","POST"})
     */
    public function new0102(Request $request): Response
    {
        $post01 = new Post01();
        $form = $this->createForm(Post011_02Type::class, $post01);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post01);
            $entityManager->flush();

            return $this->redirectToRoute('post01_index');
        }

        return $this->render('product/post01/new.html.twig', [
            'post01' => $post01,
            'form' => $form->createView(),
        ]);
    }

}
