<?php

namespace CarouselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Carousel;

class DefaultController extends Controller
{
    /**
     * @Route("/carousel", name="carousel")
     */
    public function indexAction()
    {
        $objects = $this->get('symfonyzero.carousel.manager')->all();

        return $this->render('CarouselBundle:Default:index.html.twig', array('objects' => $objects, 'path' => $this->getParameter('app.path.carousel_images')));
    }
}
