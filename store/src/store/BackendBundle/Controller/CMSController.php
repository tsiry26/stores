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
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('storeBackendBundle:Cms')->findAll();
        return $this->render('storeBackendBundle:CMS:list.html.twig', array('cms'=>$cms)); #Main => nom du dossier
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
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('storeBackendBundle:Cms')->find($id);
        return $this->render('storeBackendBundle:CMS:view.html.twig', array(
            'cms'=>$cms
        ));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('storeBackendBundle:Cms')->find($id);
        $em->remove($cms);
        $em->flush();
        return $this->redirectToRoute('store_backend_cms_list');
    }
}