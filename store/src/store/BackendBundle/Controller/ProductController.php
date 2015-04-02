<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductController
 * @package store\BackendBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * list my product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render('storeBackendBundle:Product:list.html.twig'); #Main => nom du dossier
    }

    /**
     * View a product
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name) #id doit être le même nom que dans la route
    {
        return $this->render('storeBackendBundle:Product:view.html.twig', array(
            'id' => $id,
            'nom' => $name
        ));
    }
}