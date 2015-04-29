<?php

namespace store\BackendBundle\Repository;


use Doctrine\ORM\EntityRepository;

/**
 * Class ProductRepository
 * @package store\BackendBundle\Repository
 */
class ProductRepository extends EntityRepository
{

    /**
     * Get all product of an user
     * @param null $user
     */
    public function getProductByUser($user = null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
            "
            SELECT p
            FROM storeBackendBundle:Product p
            WHERE p.jeweler= :user"
        )
            ->setParameter('user',$user);

        //Je dois retourner la requête pour le tri
        return $query/*->getResult()*/;
    }

    /**
     * COUNT All Product
     * SELECT COUNT(id)
     * FROM 'product'
     * WHERE 'jeweler_id'=1
     * @param null $user
     * @return mixed
     */
    public function getCountByUser($user = null)
    {
        //compte le nbr de produits pour 1 bijoutier
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT COUNT (p) AS nb
                FROM storeBackendBundle:Product p
                WHERE p.jeweler= :user"
            )
            ->setParameter('user',$user);

        // retourne 1 résultat ou null
        return $query->getOneOrNullResult();
    }

    public function getSumProduct($user = null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT SUM (p.price*p.quantity) AS somme
                FROM storeBackendBundle:Product p
                WHERE p.jeweler= :user"
            )
            ->setParameter('user',$user);

        // retourne 1 résultat ou null
        return $query->getOneOrNullResult();
    }

    public function getProductByUserBuilder($user)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->where('p.jeweler = :user')
            ->orderBy('p.title','ASC')
            ->setParameter('user', $user);

        return $queryBuilder;
    }

    public function getProductsQuantityIsLower($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT p
                FROM storeBackendBundle:Product p
                WHERE p.jeweler= :user
                AND p.quantity < 5"
            )
            ->setParameter('user',$user);

        // retourne 1 résultat ou null
        return $query->getResult();
    }

}
