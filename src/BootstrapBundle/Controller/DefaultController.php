<?php

namespace BootstrapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Carrusel;

class DefaultController extends Controller
{
    /**
     * @Route("/carrusel")
     * @Template()
     *
     */
    public function indexAction()
    {
     $texts =  $this->getDoctrine()
         ->getRepository('AppBundle:Carrusel')
         ->findAll();

        return $this->render('BootstrapBundle:Default:index.html.twig', array('text1' =>$texts[0]->getText(),
            'text2' =>$texts[1]->getText(),'text3' =>$texts[2]->getText(),'text4' =>$texts[3]->getText()));
    }
}
