<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 13/04/15
 * Time: 14:16
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrdersRepository extends EntityRepository
{
    public function getCountByUser($user = null)
    {
        //compte le nbr de produits pour 1 bijoutier
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT COUNT (o) AS nb
                FROM storeBackendBundle:Orders o
                WHERE o.jeweler= :user
                GROUP BY o.jeweler"
            )
            ->setParameter('user',$user);

        return $query->getOneOrNullResult();
    }
    public function getLastOrders ($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT o AS last
                FROM storeBackendBundle:Orders o
                WHERE o.jeweler= :user
                ORDER BY o.dateCreated DESC"
            )
            ->setParameter('user',$user)
            ->setMaxResults(5);

        return $query->getResult();
    }
} 