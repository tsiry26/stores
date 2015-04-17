<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 10/04/15
 * Time: 18:22
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CmsRepository extends EntityRepository
{
    public function getCmsByUser($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT c
                FROM storeBackendBundle:Cms c
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
                FROM storeBackendBundle:Cms c
                WHERE c.jeweler= :user"
            )
            ->setParameter('user',$user);

        // retourne 1 résultat ou null
        return $query->getOneOrNullResult();
    }
    public function getCmsByUserBuilder($user)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->where('c.jeweler=:user')
            ->orderBy('c.title','ASC')
            ->setParameter('user', $user);

        return $queryBuilder;
    }
}