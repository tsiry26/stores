<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 13/04/15
 * Time: 16:47
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
    public function getLastMessage($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT m AS last
                FROM storeBackendBundle:Message m
                WHERE m.jeweler= :user
                ORDER BY m.dateCreated DESC"
            )
            ->setParameter('user',$user)
            ->setMaxResults(3);

        return $query->getResult();
    }
} 