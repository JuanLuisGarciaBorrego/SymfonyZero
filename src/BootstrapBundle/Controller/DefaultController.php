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
     $text1 = $this->getDoctrine()
         ->getRepository('AppBundle:Carrusel')
         ->find(1);
     $text2= $this->getDoctrine()
         ->getRepository('AppBundle:Carrusel')
         ->find(2);
     $text3 = $this->getDoctrine()
         ->getRepository('AppBundle:Carrusel')
         ->find(3);
     $text4 = $this->getDoctrine()
         ->getRepository('AppBundle:Carrusel')
         ->find(4);

        return $this->render('BootstrapBundle:Default:index.html.twig', array('text1' =>$text1->getText(),
            'text2' =>$text2->getText(),'text3' =>$text3->getText(),'text4' =>$text4->getText()));
    }
}
