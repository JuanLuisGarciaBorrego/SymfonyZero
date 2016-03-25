<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('to', \Symfony\Component\Form\Extension\Core\Type\EmailType::class,["required" =>true])
            ->add("from", \Symfony\Component\Form\Extension\Core\Type\EmailType::class,array())
            ->add("message",TextareaType::class,array("required"=>true))
            ->add("send",  \Symfony\Component\Form\Extension\Core\Type\SubmitType::class,array())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
//            'data_class' => 'AppBundle\Entity\Notas',
//            'ambito_options'=>$this->ambito_options
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_contacto';
    }
}
