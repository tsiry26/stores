<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 27/04/15
 * Time: 12:53
 */

namespace store\BackendBundle\Listener;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use store\BackendBundle\Entity\Product;
use store\BackendBundle\Notification\Notification;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\Constraints\DateTime;


class ProductListener {

    /**
     * @var Notification
     */
    protected $notification;

    /**
     * @var
     */
    protected $em;

    /**
     * Constructeur qui reçoit le service de notification
     * On récupère le manager de doctrine en 2e arguments
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Cette méthode sera appelé depuis mon services.yml
     * Et recoie en argument mon evenement Doctrine 2
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        //Je récupère mon objet après modification (update)
        $entity = $args->getEntity();
        $em= $args->getEntityManager(); // récupérer l'entité Product

        // Si mon objet est un objet de mon entité Product
        if ($entity instanceof Product) {


            $title = $entity->getTitle();

            $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
            $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');

            // slugifié mon titre stocké dans une variable slug
            $slug = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$title)));

            // setSlug me permet de modifier le slug de mon produit
            $entity->setSlug($slug);

            $em->persist($entity);
            $em->flush();

            // si ma quantité est < à 5
            if($entity->getQuantity() < 5)
            {
                $this->notification->notify($entity->getId(),
                    "Attention votre produit ".$entity->getTitle()." est bientôt épuisé",
                    "product",
                    "warning");
            }

            if($entity->getQuantity() == 1)
            {
                $this->notification->notify($entity->getId(),
                    "Attention votre produit ".$entity->getTitle()." a une seule quantité",
                    "product",
                    "danger");
            }
        }

    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->postUpdate($args);
    }

    /**
     * Avant la persistance de mon Objet
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        // Je récupère mon objet avant la persistance de mon objet
        $entity = $args->getEntity();

        // si mon objet est un objet de mon entité Product
        if ($entity instanceof Product)
        {
            $now = new \DateTime('now'); //Objet Datetime à aujourd'hui pour récupérer la date
            $entity->setDateUpdated($now); //Modification de la date Updated
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->prePersist($args);
    }
} 