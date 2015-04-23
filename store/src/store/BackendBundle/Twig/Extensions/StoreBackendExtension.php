<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 23/04/15
 * Time: 18:06
 */

namespace store\BackendBundle\Twig\Extensions;


class StoreBackendExtension extends \Twig_Extension
{
    /**
     * Function qui me retourne tous mes filtres crée
     * @return array
     */
    public function getFilters()
    {
        //retourne un tableau de filtre
        return array(
            //Twig_SimpleFilter:
            // -1er argument est le nom du filtre TWIG
            // -2eme argument est le nom de la fonction que je vais crée
            new \Twig_SimpleFilter('state', array($this, 'state')),
        );
    }

    public function state($state)
    {
        if($state == 2){
            $badge= "<span class='label label-success'>Actif</span>";
        }elseif($state == 1){
            $badge= "<span class='label label-info'>En cours</span>";
        }
        else{
            $badge = "<span class='label label-warning'>Annulé</span>";
        }

        return $badge;
    }


    public function getName()
    {
        return 'store_backend_extension';
    }

} 