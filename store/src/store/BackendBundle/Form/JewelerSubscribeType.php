<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 21/04/15
 * Time: 17:48
 */

namespace store\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JewelerSubscribeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
            'label'=>'Nom de la bijouterie',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Nom / Marque du bijoutier',
                'pattern'=>'[a-zA-Z0-9- ]{5,}'
            )
        ));


        $builder->add('username', null, array(
            'label'=>"Nom d'utilisateur",
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>"Login choisi",
                'pattern'=>'[a-zA-Z0-9- ]{5,}'
            )
        ));

        $builder->add('email', 'email', array(
            'label'=>"Email d'utilisateur",
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>"Votre email"
            )
        ));

        $builder->add('password', 'repeated', array(
            'required' => true,
            'attr' => array('autocomplete', 'off'),
            'type' => 'password',
            'first_name' => 'mdp',
            'second_name' => 'mdp_conf',
            'invalid_message' => 'Les mots de passe doivent correspondre',
            'error_bubbling' => true,
            'first_options'  => array(
                'label' => 'Mot de passe',
                'attr' => array('value'=>'',
                                'autocomplete' => 'off',
                                 'placeholder' => 'Au moins 6 caractères',
                                 'pattern'=>'.{6,}')),
            'second_options' => array(
                'label' => 'Confirmation de mot de passe',
                 'attr' => array('value'=>'',
                                'autocomplete' => 'off',
                                 'placeholder' => 'Retaper votre mot de passe',
                                 'pattern'=>'.{6,}')),
        ));

        $builder->add('envoyer','submit', array(
            'attr'=>array(
                'class'=>'btn btn-primary btn-sm',
            )
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'store\BackendBundle\Entity\Jeweler',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "store_backend_subscribe";
    }

} 