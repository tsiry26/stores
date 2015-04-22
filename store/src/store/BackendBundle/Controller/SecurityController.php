<?php
/**
 * Created by PhpStorm.
 * User: wac22
 * Date: 20/04/15
 * Time: 12:32
 */

namespace store\BackendBundle\Controller;

use Store\BackendBundle\Entity\Jeweler;
use Store\BackendBundle\Form\JewelerSubscribeType;
use Symfony\Component\httpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller {

    /**
     * Page login
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        /**
         * On interroge le mécanisme de sécurité de Symfony2 en session
         * Qui vérifie le bon login et le bon mot de passe en sécurité
         */
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        // je retourne la vue login de mon dossier Security
        return $this->render('storeBackendBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function subscribeAction(REQUEST $request)
    {

        $jeweler = new Jeweler();

        // je crée mon formulaire d'inscription au jeweler
        $form = $this->createForm(new JewelerSubscribeType(), $jeweler, array(
            'validation_groups' => 'subscribe',
            'attr' => array(
                'method' => 'post',
                'novalidate' => 'novalidate',
                'action' => $this->generateUrl('store_backend_security_subscribe')
            )
        ));

        // je lie le formulaire à la requete
        $form->handleRequest($request);

        // je valide mon formulaire
        if($form->isValid())
        {
            // 1.je récup mon champ password
            $password = $form['password']->getData();

            // récupérer le service d'encodage de la sécurité de symfo2; Encodage sha512
            $factory = $this->get('security.encoder_factory');

            // 2.je récupére l'encoder de mon jeweler (sha512)
            $encoder = $factory->getEncoder($jeweler);

            // 3.j'encode mon mot de passe avec l'encoder et j'y ajoute le salt
            $password = $encoder->encodePassword($password, $jeweler->getSalt());

            $jeweler->setPassword($password); // 4.modifier le mot de passe encoder avec l'encodage

            $em = $this->getDoctrine()->getManager(); // je récupérer le manager de doctrine

            //5.j'ajoute le groupe à l'utilisateur
            $group = $em->getRepository('storeBackendBundle:Groups')->find(1);
            $jeweler->addGroup($group);

            $em->persist($jeweler);

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre compte a bien été crée'
            );

            $this->get('session')->getFlashBag()->add(
                'info',
                'Vous pouvez vous connecter sur le back-office'
            );

            return $this->redirectToRoute('store_backend_security_login');
        }

        return $this->render('storeBackendBundle:Security:subscribe.html.twig', array('form'=>$form->createView()));
    }

} 