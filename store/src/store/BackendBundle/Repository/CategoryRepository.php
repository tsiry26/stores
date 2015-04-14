<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 10/04/15
 * Time: 18:03
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getCategoryByUser($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT c
                FROM storeBackendBundle:Category c
                WHERE c.jeweler= :user"
            )
            ->setParameter('user', $user);
        return $query->getResult();
    }

    public function getCountByUser($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT COUNT (c) AS nb
                FROM storeBackendBundle:Category c
                WHERE c.jeweler= :user"
            )
            ->setParameter('user',$user);

        // retourne 1 résultat ou null
        return $query->getOneOrNullResult();
    }

    public function getCategPopular($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT c
                FROM storeBackendBundle:Category c
                WHERE c.jeweler= :user AND c.position>=1
                ORDER BY c.position ASC "
            )
            ->setParameter('user',$user);

        // retourne 1 résultat ou null
        return $query->getResult();
    }
} 