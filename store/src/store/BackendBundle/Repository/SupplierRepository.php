<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 10/04/15
 * Time: 18:26
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SupplierRepository extends EntityRepository
{
    public function getSupplierByUser($user=null)
    {
        /*
         * Récupère les fournisseurs
         * où la boutique de mes produit est égale à mon paramètre
         *
         */
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT s
                FROM storeBackendBundle:Supplier s
                JOIN s.product p
                WHERE p.jeweler= :user
                GROUP BY p.jeweler"
            )
            ->setParameter('user', $user);
        return $query->getResult();
    }
}