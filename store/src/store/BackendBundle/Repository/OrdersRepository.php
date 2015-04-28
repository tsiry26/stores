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

   /* public function getOrderByUser($user = null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT o
                FROM storeBackendBundle:Orders o
                WHERE o.jeweler= :user"
            )
            ->setParameter('user',$user);

        return $query->getResult();
    }*/

    /**
     * Requête qui sort la commande des 6 derniers mois
     * SELECT COUNT(id)
     * FROM 'orders AS o
     * WHERE o.date
     * BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH)
     * AND NOW()
     * GROUP BY MONTH (o.date)
     */
    public function getOrderGraphByUser($user, $dateBegin)
    {
        //compter le nombre de commande pour un jeweler préçis et pour un mois préçis
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT COUNT (o) AS nb, DATE_FORMAT(:dateBegin, '%Y-%m') AS d
                FROM storeBackendBundle:Orders o
                WHERE o.jeweler = :user
                AND MONTH (o.dateCreated) = :month
                AND YEAR (o.dateCreated) = :year
                "
            )
            ->setParameters(array(
                'user' => $user,
                'dateBegin' => $dateBegin->format('Y-m-d'),
                'month' => $dateBegin->format('m'),
                'year' => $dateBegin->format('Y')
            ));
        //retourne 1 seul résultat
        return $query->getSingleResult();

    }

    public function getLastOrdersByUser($user, $limit=5)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT o
                FROM storeBackendBundle:Orders o
                WHERE o.jeweler= :user
                ORDER BY o.dateCreated DESC"
            )
            ->setParameter('user',$user)
            ->setMaxResults($limit);

        return $query->getResult();
    }

} 