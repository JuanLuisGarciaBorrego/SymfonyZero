<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array(
            'label' => 'Email Address',
            'translation_domain' => 'FOSUserBundle',
            'attr' => array(
                'class' => 'form-control'
            )))

          ->add('username', null, array(
            'label' => 'Username',
            'translation_domain' => 'FOSUserBundle',
            'attr' => array(
                'class' => 'form-control'
            )))
          ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
              'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
              'options' => array('translation_domain' => 'FOSUserBundle'),
              'first_options' => array(
                  'label' => 'Password',
                  'attr' => array(
                    'class' => 'form-control'
                  )),
              'second_options' => array(
                'label' => 'Repeat Password',
                'attr' => array(
                    'class' => 'form-control'
                )),
              'invalid_message' => 'Passwords doesn\'t match',
            ));
    }

    public function getName()
    {
        return 'user_registration';
    }
}
