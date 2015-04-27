<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use store\BackendBundle\Entity\Product;
use store\BackendBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * Class ProductController
 * @Security("has_role('ROLE_COMMERCIAL')")
 * @package store\BackendBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * list my product
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {

        //Méthode numéro1: restreindre l'accès au niveau de ma methode de controller
       /* if (false === $this->get('security.context')->isGranted('ROLE_COMMERCIAL')) {
            throw new AccessDeniedException("Accès interdit pour ce type de contenu");
        }*/

        // récupère le manager de doctrine : le conteneur d'objets de Doctrine
            $em = $this->getDoctrine()->getManager();

        // récupérer l'utilisateur connecté
            $user=$this->getUser();

            // Je récupère tous les produits
            $products = $em->getRepository('storeBackendBundle:Product')->getProductByUser($user);//Nom du Bundle: Nom de l'entité
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

        $user=$this->getUser();
       /* $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find($user);*/
        $product->setJeweler($user);//j'associe mon jewler 1 à mon produit

        //J'initialise la quantité et le prix à mon produit
        /*$product->setQuantity(0);
        $product->setPrice(0);*/

        //créer un formulaire de produit
        $form= $this->createForm(new ProductType($user),$product,
            array(
                'validation_groups'=> 'new',
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
            //j'upload mon fichier en faisant appel a la methode upload
            $product->upload();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            //Je créer un message flash avec pour clef "succes" et un message de confirmation
            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre produit a été bien créer'
            );

            //je récupère la quantité
            $quantity=$product->getQuantity();

           /* if($quantity==1){
                //$this->get()=>accède au conteneur de service
                //la méthode notify ajout une notification
                $this->get('store.backend.notification')->notify($product->getId(),
                    "Votre produit ".$product->getTitle()." est unique",
                    "product",
                    "danger");
            }
            else if($quantity<5){
                //$this->get()=>accède au conteneur de service
                //la méthode notify ajout une notification
                $this->get('store.backend.notification')->notify($product->getId(),
                                                             "La quantité du produit ".$product->getTitle()." est faible",
                                                             "product",
                                                                "warning");
            }*/

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre produit a bien été créer'
            );

            return $this->redirectToRoute('store_backend_product_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Product:new.html.twig',array("form"=> $form->createView()));
    }


    /**
     * Param convertir un int en objet Product directement
     * Je récupère l'objet Request qui contient toutes mes données en GET, POST...
     *
     */
    public function editAction(Request $request,Product $id)
    {
        //Je récupère le doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        //je vais rechercher un objet Produit existant par son id
        /*$product=$em->getRepository('storeBackendBundle:Product')->find($id);*/

        //Je récupère un jeweler numéro 1
       /* $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find(1);
        $product->setJeweler($jeweler);//j'associe mon jewler 1 à mon produit*/

        //Je crée un formulaire de produit en associant avec mon produit
        $form= $this->createForm(new ProductType($user),$id,
            array(
                'validation_groups'=> 'edit',
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_product_edit', array('id' => $id->getId()))
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            //Si ma quantité de produit est inférieur à 5
            /*if($id->getQuantity()==1){
                //$this->get()=>accède au conteneur de service
                //la méthode notify ajout une notification
                $this->get('store.backend.notification')->notify($id->getId(),
                    "Votre produit ".$id->getTitle()." est unique",
                    "product",
                    "danger");
            }
            else if($id->getQuantity()<5){
                //$this->get()=>accède au conteneur de service
                //la méthode notify ajout une notification
                $this->get('store.backend.notification')->notify($id->getId(),
                    "Attention votre produit ".$id->getTitle()." est bientôt épuisé",
                    "product",
                    "warning");
            }*/

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre produit a bien été modifié'
            );

            return $this->redirectToRoute('store_backend_product_list'); //redirection selon la route
        }

        return $this->render('storeBackendBundle:Product:edit.html.twig',array("form"=> $form->createView()));
    }

    public function activateAction(Product $id, $action)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setActive($action);
        $em->persist($id);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
           'success',
           'Votre produit a bien été modifié'
       );
        return $this->redirectToRoute('store_backend_product_list');
    }

    public function coverAction(Product $id, $action)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setCover($action);
        $em->persist($id);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            'Votre page de couverture a bien été modifié'
        );
        return $this->redirectToRoute('store_backend_product_list');
    }

}