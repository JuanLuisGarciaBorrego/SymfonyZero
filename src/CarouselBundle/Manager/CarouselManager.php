<?php

namespace CarouselBundle\Manager;

use AppBundle\Manager\BaseManager;
use CarouselBundle\Entity\Carousel;

class CarouselManager extends BaseManager
{
    public function createCarousel() {
        return new Carousel();
    }
}
