<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 28/04/15
 * Time: 14:21
 */

namespace store\BackendBundle\Security\Authorization\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Class OwnerVoter: qui va voter si l'utilisateur  est permis de faire une action
 * @package store\BackendBundle\Security\Authorization\Voter
 */
class OwnerVoter implements VoterInterface
{

    public function __construct(){

    }

    /**
     * Cette méthode permet de récupérer le(s) attribut(s) envoyés depuis mon controleur
     * @param string $attribute An attribute
     *
     * @return bool true if this Voter supports the attribute, false otherwise
     */
    public function supportsAttribute($attribute)
    {
        return true;
    }

    /**
     * Me permet de faire des restrictions sur l'utilisation de ce Voter
     * @param string $class A class name
     *
     * @return bool true if this Voter can process the class
     */
    public function supportsClass($class)
    {
        return true;
    }

    /**
     * Mécnisme que l'on implémente pour voter les droits
     * et permission de l'utilisateur
     *
     * @param TokenInterface $token A TokenInterface instance
     * @param object|null $object The object to secure
     * @param array $attributes An array of attributes associated with the method being invoked
     *
     * @return int either ACCESS_GRANTED, ACCESS_ABSTAIN, or ACCESS_DENIED
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        /**
         * VotreInterface::ACCESS_DENIED: Acces non permis(403)
         * VotreInterface::ACCESS_GRANDED: Acces autorisée
         * VotreInterface::ACCESS_ABSTAIN: S'abstenir de voter sur le mécanisme d'authorisation
         */
        $user = $token->getUser();

        //si l'utilisateur n'est pas connecté
        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        //si le jeweler id est égale à l'id de l'utilisateur
        if(method_exists($object, 'getJeweler')){
            if($object->getJeweler()->getId() == $user->getId()) {
                return VoterInterface::ACCESS_GRANTED; //acces permis
            }
        }

        return VoterInterface::ACCESS_DENIED;
    }

} 