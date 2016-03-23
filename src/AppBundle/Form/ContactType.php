<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
        $builder
            ->add('to','text',array(
               "required" =>true,               
            ))
            ->add("from","text",array())
            ->add("message","textarea",array(
                "required"=>true
            ))
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
