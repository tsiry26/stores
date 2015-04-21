<?php
namespace store\BackendBundle\Controller;


use store\BackendBundle\Form\JewelerSubscribeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        /**
         * On interroge le mecanisme de sécurité de Symfony 2 en session
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

        //Je retourne la vue login de mon dossier Security
        return $this->render('storeBackendBundle:Security:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * Subscribe Page for Jewler
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function subscribeAction()
    {
        //Je crée mon formulaire d'inscription de Jeweler
        $form = $this->createForm(new JewelerSubscribeType());
        return $this->render('storeBackendBundle:Security:subscribe.html.twig', array(
            'form' => $form->createView()
        ));
    }
}