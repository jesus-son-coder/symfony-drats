<?php


namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/following")
 */
class FollowingController extends Controller
{
    /**
     * @Route("/follow/{id}", name="following_follow")
     */
    public function follow(User $userToFollow)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        /* Eviter que l'utilisateur connecté puisse exécuter l'action : */
        if($userToFollow->getId() !== $currentUser->getId()) {

            /* Ajouter le User en paramètre dans sa liste de Followers :
            $currentUser->getFollowing()
                ->add($userToFollow);  */

            $currentUser->follow($userToFollow);

            $this->getDoctrine()
                ->getManager()
                ->flush();
        }

        return $this->redirectToRoute('micro_post_user', [
            'username' => $userToFollow->getUsername()
        ]);
    }

    /**
     * @Route("/unfollow/{id}", name="following_unfollow")
     */
    public function unfollow(User $userToUnFollow)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        /* Eviter que l'utilisateur connecté puisse exécuter l'action : */
        if($userToUnFollow->getId() !== $currentUser->getId()) {

            /* Retrancher le User en paramètre de sa liste de Followers : */
            $currentUser->getFollowing()->removeElement($userToUnFollow);

            $this->getDoctrine()
                ->getManager()
                ->flush();

        }

        return $this->redirectToRoute('micro_post_user', [
            'username' => $userToUnFollow->getUsername()
        ]);
    }
}