<?php


namespace App\Controller;


use App\Entity\MicroPost;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/likes")
 */
class LikesController extends Controller
{
    /**
     * @Route("/like/{id}", name="likes_like")
     */
    public function like(MicroPost $microPost)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        if(!$currentUser instanceof User) {
            return new JsonResponse([], Response::HTTP_UNAUTHORIZED); // error 401
        }

        $microPost->like($currentUser);

        /* If we make changes on Entity that already exits, we don't need to call the "persist()" method
            but we can directly call the "flush()" methode : */
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            // le type Collection permet d'interroger directement le nombre total d'un élément grace à la méthode count() :
                'count' => $microPost->getLikedBy()->count()
            ]
        );
    }

    /**
     * @Route("/unlike/{id}", name="likes_unlike")
     */
    public function unlike(MicroPost $microPost)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        if(!$currentUser instanceof User) {
            return new JsonResponse([], Response::HTTP_UNAUTHORIZED); // error 401
        }

        $microPost->getLikedBy()->removeElement($currentUser);

        /* If we make changes on Entity that already exits, we don't need to call the "persist()" method
            but we can directly call the "flush()" methode : */
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
                // le type Collection permet d'interroger directement le nombre total d'un élément grace à la méthode count() :
                'count' => $microPost->getLikedBy()->count()
            ]
        );
    }
}