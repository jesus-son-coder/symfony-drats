<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 13/05/2019
 * Time: 01:08
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('security/login.html.twig', [
            // retrouver une erreur d'authentification s'il y en a une :
            'error' => $utils->getLastAuthenticationError(),
            // retrouver le dernier identifiant de connexion utilisé
            'last_username' => $utils->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        /*
         * La fonction de déconnexion doit vous surprendre !
         * Nous avons dit qu'une action doit toujours retourner une réponse :
         * en fait, cette fonction ne sera jamais exécutée.
         * Le composant Sécurité a seulement besoin d'une URL pour effectuer la déconnexion.
         */
    }
}