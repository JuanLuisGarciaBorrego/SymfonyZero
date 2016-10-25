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
        $menu->addChild('Included Bundles', array('route' => 'included-bundles'));
        $menu->addChild('Contact', array('route' => 'contact'));
        if(isset($options['admin']) && $options['admin']==1){
            $menu->addChild('EasyAdmin ', array('route' => 'admin'));
        }
        $menu->addChild('About', array('route' => 'about'));

        //set ul classes
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        return $menu;
    }
}
