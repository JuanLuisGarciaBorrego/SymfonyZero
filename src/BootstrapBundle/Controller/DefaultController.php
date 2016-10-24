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

      foreach($texts as $textK => $textV){
        $object[] = array('text' =>  $texts[$textK]->getText(), 'file'=> $this->getParameter('app.path.carrusel_images').$texts[$textK]->getImageName());
      }
      if(isset($object)){
        return $this->render('BootstrapBundle:Default:index.html.twig',array('objects'=>$object));
      }else {
        return;
      }
    }
}
