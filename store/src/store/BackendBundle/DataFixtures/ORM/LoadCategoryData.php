<?php

namespace store\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use store\BackendBundle\Entity\Category;
use store\BackendBundle\Entity\Product;


/**
 * Cette classe me permettra de charger des catégories en base de données
 * Class LoadUserData
 * @package store\BackendBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    /**
     * Cette méthode me permettra de charger mes données
     * (catégories)
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $categorie = new Category();
        $categorie->setTitle('Colliers Magnifiques');
        $categorie->setDescription('Jolies Description de vos magnifiques colliers');

        $categorie2 = new Category();
        $categorie2->setTitle('Bracelets Glamours');
        $categorie2->setDescription('Belle description complete de vos bracelets glamours');

       /* $product = new Product();
        $product->addCategory($categorie);
        $product->setTitle('Collier Azure Ete');
        $product->setDescription('Collier composé de perles macrées avec vernissage et finition de pierres  Sxss');

        $manager->persist($product);*/
        $manager->persist($categorie);
        $manager->persist($categorie2);
        $manager->flush();
    }
}
