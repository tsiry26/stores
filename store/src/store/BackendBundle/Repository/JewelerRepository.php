<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 14/04/15
 * Time: 11:08
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class JewelerRepository extends EntityRepository
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
}