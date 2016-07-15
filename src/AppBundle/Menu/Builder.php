<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage','class'=>'testClass'));
        $menu->addChild('Included Bundles', array(
            'route' => 'included-bundles',
        ));
        $menu->addChild('Contact', array(
            'route' => 'contact',
        ));
        $menu->addChild('About', array(
            'route' => 'about',
        ));

        if(isset($options['admin']) && $options['admin']==1){
            $menu->addChild('EasyAdmin ', array(
                'route' => 'admin',
            ));
        }


        //Login / Logout (Login normal / Login GOOGLE)
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (is_object($user) && get_class($user) == 'AppBundle\Entity\User') {
        	$menu->addChild('Logout (' . $user->getUserName().")", array(
        			'route' => 'fos_user_security_logout',
        	));
        } else {
        	$menu->addChild('Login with Google account', array(
        			'route' => 'hwi_oauth_service_redirect',
        			'routeParameters' => array('service' => 'google')
        	));
        }

        //set ul classes
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        return $menu;
    }
}
