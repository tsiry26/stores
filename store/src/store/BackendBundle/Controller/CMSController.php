<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CategoryController
 *
 */
class CMSController extends Controller
{
    /**
     * list my cms
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render('storeBackendBundle:CMS:list.html.twig'); #Main => nom du dossier
    }

    /**
     * view a cms
     * @param $name
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name)
    {
        // return view de categorie où je transmet l'id en vue
        return $this->render('storeBackendBundle:CMS:view.html.twig', array(
            'id'=>$id,
            'nom' =>$name
        ));
    }
}