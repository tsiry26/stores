<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 22/04/15
 * Time: 15:44
 */

namespace store\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SliderRepository extends EntityRepository
{
    public function getSliderByUser($user = null)
    {
        $query=$this->getEntityManager()
            ->createQuery(
                "
                SELECT s
                FROM storeBackendBundle:Slider s
                JOIN s.product p
                WHERE p.jeweler= :user"
            )
            ->setParameter('user',$user);

        return $query->getResult();
    }
}