<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CategoryController
 *
 */
class SupplierController extends Controller
{
    /**
     * list my category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $suppliers = $em->getRepository('storeBackendBundle:Supplier')->getSupplierByUser(1);
        return $this->render('storeBackendBundle:Supplier:list.html.twig', array('suppliers'=> $suppliers)); #Main => nom du dossier
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
        $supplier = $em->getRepository('storeBackendBundle:Supplier')->find($id);
        // return view de categorie où je transmet l'id en vue
        return $this->render('storeBackendBundle:Supplier:view.html.twig', array(
            'supplier'=>$supplier
        ));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $supplier = $em->getRepository('storeBackendBundle:Supplier')->find($id);
        $em->remove($supplier);
        $em->flush();
        return $this->redirectToRoute('store_backend_supplier_list');
    }
}