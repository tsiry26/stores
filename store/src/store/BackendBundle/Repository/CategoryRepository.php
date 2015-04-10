<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 10/04/15
 * Time: 18:03
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getCategoryByUser($user=null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT c
                FROM storeBackendBundle:Category c
                WHERE c.jeweler= :user"
            )
            ->setParameter('user', $user);
        return $query->getResult();
    }

} 