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
            'error' => $utils->getLastAuthenticationError(),
            'last_username' => $utils->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {

    }
}