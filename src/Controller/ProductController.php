<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 30/04/2019
 * Time: 23:26
 */
namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @Route("/product/add", name="product_add")
     *
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request) {

        /* On récupère la catégorie qui doit être associée apr défaut à un produit : */
        $repo = $this->getDoctrine()->getRepository('App:Category');
        $defaultCategory = $repo->find(2);

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, [
            'defaultCategory'=> $defaultCategory
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return new Response('Produit ajouté');
        }

        $formView = $form->createView();
        return $this->render('productAdd.html.twig',array(
                'form' => $formView)
        );
    }
}