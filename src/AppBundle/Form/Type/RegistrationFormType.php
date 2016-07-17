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
          ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
          ->add('username', null, array('label' => 'Username', 'translation_domain' => 'FOSUserBundle'))
          ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
              'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
              'options' => array('translation_domain' => 'FOSUserBundle'),
              'first_options' => array('label' => 'Password'),
              'second_options' => array('label' => 'Repeat Password'),
              'invalid_message' => 'fos_user.password.mismatch',
          ))
      ;
    }

    public function getName()
    {
        return 'user_registration';
    }
}
