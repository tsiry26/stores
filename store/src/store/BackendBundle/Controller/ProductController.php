<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use store\BackendBundle\Form\ProductType;
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
        // récupère le manager de doctrine : le conteneur d'objets de Doctrine
            $em = $this->getDoctrine()->getManager();

            // Je récupère tous les produits
            $products = $em->getRepository('storeBackendBundle:Product')->getProductByUser(1);//Nom du Bundle: Nom de l'entité
            //=Requête: SELECT*FROM product

            return $this->render('storeBackendBundle:Product:list.html.twig',array('products'=> $products));
    }

    /**
     * View a product
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name) #id doit être le même nom que dans la route
    {
        // récupère le manager de doctrine : le conteneur d'objets de Doctrine
        $em = $this->getDoctrine()->getManager();

        // Je récupère tous les produits de ma base de données avec la méthode findAll
        $product = $em->getRepository('storeBackendBundle:Product')->find($id);

        return $this->render('storeBackendBundle:Product:view.html.twig', array(
            'product' => $product
        ));
    }

    public function removeAction($id)
    {
        // récupère le manager de doctrine : le conteneur d'objets de Doctrine
        $em = $this->getDoctrine()->getManager();

        // Je récupère tous les produits de ma base de données avec la méthode findAll
        $product = $em->getRepository('storeBackendBundle:Product')->find($id);

        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('store_backend_product_list');
    }

    /**
     * Page new action
     */
    public function newAction()
    {
        //créer un formulaire de produit
        $form= $this->createForm(new ProductType());

        return $this->render('storeBackendBundle:Product:new.html.twig',array("form"=> $form->createView()));
    }
}