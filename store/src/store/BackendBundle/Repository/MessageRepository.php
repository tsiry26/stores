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

    /**
     * Récupère les messages de l'utilisateur
     * @param $user
     * @param int $limit
     * @return mixed
     */
    public function getLastMessagesByUser($user, $limit=5)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT m
                FROM storeBackendBundle:Message m
                WHERE m.jeweler= :user
                ORDER BY m.id DESC"
            )
            ->setParameter('user',$user)
            ->setMaxResults($limit);

        return $query->getResult();
    }
} 