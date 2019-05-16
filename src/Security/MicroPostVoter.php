<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 14/05/2019
 * Time: 09:04
 */

namespace App\Security;

use App\Entity\MicroPost;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MicroPostVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    private $accessDecisionManager;

    public function __construct(AccessDecisionManagerInterface $accessDecisionManager)
    {
        $this->accessDecisionManager = $accessDecisionManager;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute. Il could be "Edit" or "Delete" or "Create"
     * @param mixed $subject The subject to secure, e.g. an object (like "MicroPost") the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        if(!$subject instanceof MicroPost) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /* Si l'utilisateur a le rôle "ADMIN", alors on lui donne d'emblée tous les droits sur les différents attributs,
            et pas besoin de poursuivre les autres vérifications, on fait un "return" sur  la fonction : */
        if($this->accessDecisionManager->decide($token, [User::ROLE_ADMIN])) {
            return true;
        }

        /* Récupération de l'utilisateur actuellement connecté : */
        $authenticatedUser = $token->getUser();

        /* Nous ne souhaitons pas qu'unn utlisateur non connecté puisse effectuer les actions
            mentionnés dans le paramètre "$attributes" (à savoir : "EDIT" ou "DELETE") */
        if(!$authenticatedUser instanceof User) {
            return false;
        }
        /**
         * @var MicroPost $microPost
         */
        $microPost = $subject;

        /* Nous allons ensuite vérifier que l'Utilisateur ayant publié le MicorPost est le meême que l'Utilisateur connecté. Car la règle serait que : seuls les utilsiateurs ayant publié des articles ont le droit d'éditer ou de supprimer que leurs propres articles.
        Cette condition est la seule suffisante pour accorder les droits de modification ou de suppression à l'utilisateur qui en fait la demande. Voilà pourquoi nous effectuons un 'return" à ce niveau :
         */
        return ($microPost->getUser()->getId() === $authenticatedUser->getId());

    }

}