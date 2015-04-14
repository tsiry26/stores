<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 14/04/15
 * Time: 14:51
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;


class BusinessRepository extends EntityRepository
{
    public function getPromotion($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT b
                FROM storeBackendBundle:Business b
                JOIN b.product p
                WHERE p.jeweler= :user"
            )
            ->setParameter('user',$user);

        return $query->getResult();
    }
} 