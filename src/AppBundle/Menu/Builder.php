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

        $menu->addChild('Home', array('route' => 'homepage'));

        // access services from the container!
//        $em = $this->container->get('doctrine')->getManager();
//        // findMostRecent and Blog are just imaginary examples
//        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Included Bundles', array(
            'route' => 'included-bundles',
        ));
        $menu->addChild('About', array(
            'route' => 'about',
        ));
        $menu->addChild('Contact', array(
            'route' => 'contact',
//            'routeParameters' => array('id' => $blog->getId())
        ));
        
        //Login / Logout
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (is_object($user) && get_class($user) == 'AppBundle\Entity\User') {
        	$menu->addChild('Logout ' . $user->getUserName(), array(
        			'route' => 'fos_user_security_logout',
        	));
        } else {
        	$menu->addChild('Login', array(
        			'route' => 'fos_user_security_login',
        	));
        }
        

//        // create another menu item
//        $menu->addChild('About Me', array('route' => 'about'));
//        // you can also add sub level's to your menu's as follows
//        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));
//
//        // ... add more children

        return $menu;
    }
}
