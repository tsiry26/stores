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
}