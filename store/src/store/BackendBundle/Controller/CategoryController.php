<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CategoryController
 *
 */
class CategoryController extends Controller
{
    /**
     * list my category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render('storeBackendBundle:Category:list.html.twig'); #Main => nom du dossier
    }

    /**
     * view a category
     * @param $name
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name)
    {
        // return view de categorie où je transmet l'id en vue
        return $this->render('storeBackendBundle:Category:view.html.twig', array(
            'id'=>$id,
            'nom' =>$name
        ));
    }
}