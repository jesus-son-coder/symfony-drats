<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 01/05/2019
 * Time: 00:20
 */
namespace App\Controller\Product;

use App\Entity\Product\Category01;
use App\Form\Product\CategoryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @Route("/category/add", name="category_add")
     *
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request) {

        $category = new Category01();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return new Response('Catégorie ajoutée');
        }

        $formView = $form->createView();
        return $this->render('categoryAdd.html.twig',array(
            'form' => $formView)
        );
    }
}