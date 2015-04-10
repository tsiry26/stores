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
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('storeBackendBundle:Category')->getCategoryByUser(1);
        return $this->render('storeBackendBundle:Category:list.html.twig',array('categories'=> $categories)); #Main => nom du dossier
    }

    /**
     * view a category
     * @param $name
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('storeBackendBundle:Category')->find($id);
        // return view de categorie où je transmet l'id en vue
        return $this->render('storeBackendBundle:Category:view.html.twig', array(
            'categorie'=>$categorie
        ));
    }

    /**
     * remove
     */
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('storeBackendBundle:Category')->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('store_backend_category_list');
    }
}