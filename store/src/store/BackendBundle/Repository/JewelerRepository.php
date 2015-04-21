<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 14/04/15
 * Time: 11:08
 */

namespace store\BackendBundle\Repository;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class JewelerRepository extends EntityRepository implements UserProviderInterface
{
    public function getJewelerDetails($user = null)
    {
        //compte le nbr de produits pour 1 bijoutier
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT j AS details
                FROM storeBackendBundle:JewelerMeta j
                WHERE j.jeweler= :user"
            )
            ->setParameter('user',$user);

        return $query->getOneOrNullResult();
    }

    /**
     * Loads the user for the given username.
     * Methode de chargement de l'utilisateur par son email ou par son username
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @see UsernameNotFoundException
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        $q = $this
            ->createQueryBuilder('j')
            ->select('j, g')
            ->leftJoin('j.groups', 'g')
            ->where('j.username = :username OR j.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery();
        /**
         * Essayer de récupérer un utilisateur avec try() catch()
         */
        try {
            // La méthode Query::getSingleResult() lance une exception NoResultException
            // s'il n'y a pas d'entier correspondante aux critères
            //me retourne qu'un seul résultat avec la méthode getSingleResult()
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            // si il n'y a aucun résultat, alors on retourne aucun utilisateur
            return null;
        }

        return $user;
    }

    /**
     * Rafraichir l'utilisateur en token
     * Appeler pour Rafraichir l'utilisateur en session par son token à chaque requete
     * A chaque requete, le rafraichissement de la session se fait par le token
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)){
            //vérifie si l'entité liée est supporter par le mécanisme d'authenfication
            throw new UnsupportedUserException(
                sprintf(
                    'Instance of "%s" are not supported.',
                    $class
                )
            );
        }

        // utilise la methode find() pour retouver l'utilisateur depuis son ID
        return $this->find($user->getId());
    }

    /**
     * Whether this provider supports the given user class.
     * Méthode qui permet de déclarer cette classe repository
     * comme un Providers au mécanisme de sécurité de faire reconnaitre cette classe
     * comme EntityProvider
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }


}