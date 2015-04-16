<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use store\BackendBundle\Entity\Product;
use store\BackendBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * Je recupere l'objet request qui contient toutes mes données en GET, POST...
     */
    public function newAction(Request $request)
    {
        // Je créer une nouvelle objet entité Procduct
        $product=new Product();

        $em = $this->getDoctrine()->getManager();
        $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find(1);
        $product->setJeweler($jeweler);//j'associe mon jewler 1 à mon produit

        //J'initialise la quantité et le prix à mon produit
        /*$product->setQuantity(0);
        $product->setPrice(0);*/

        //créer un formulaire de produit
        $form= $this->createForm(new ProductType(1),$product,
            array(
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_product_new')
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            return $this->redirectToRoute('store_backend_product_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Product:new.html.twig',array("form"=> $form->createView()));
    }

    public function editAction(Request $request, $id)
    {
        // Je créer une nouvelle objet entité Procduct
        $product=new Product();

        $em = $this->getDoctrine()->getManager();
        $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find(1);
        $product->setJeweler($jeweler);//j'associe mon jewler 1 à mon produit

        //J'initialise la quantité et le prix à mon produit
        /*$product->setQuantity(0);
        $product->setPrice(0);*/

        //créer un formulaire de produit
        $form= $this->createForm(new ProductType(1),$product,
            array(
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_product_new')
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            return $this->redirectToRoute('store_backend_product_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Product:new.html.twig',array("form"=> $form->createView()));
    }
}