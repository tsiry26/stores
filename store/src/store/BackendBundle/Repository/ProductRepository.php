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

        return $query->getResult();
    }
}
