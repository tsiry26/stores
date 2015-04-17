<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 13/04/15
 * Time: 14:20
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function getCountByUser($user = null)
    {
        //compte le nbr de produits pour 1 bijoutier
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT COUNT (c) AS nb
                FROM storeBackendBundle:Comment c
                JOIN c.product p
                WHERE p.jeweler= :user
                GROUP BY p.jeweler"
            )
            ->setParameter('user',$user);

        return $query->getOneOrNullResult();
    }
    public function getlastComment($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT c AS last
                FROM storeBackendBundle:Comment c
                JOIN c.product p
                WHERE p.jeweler= :user
                ORDER BY c.dateCreated DESC"
            )
            ->setParameter('user',$user)
            ->setMaxResults(5);

        return $query->getResult();
    }
}