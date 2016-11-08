<?php

namespace AppBundle\DataFixtures\ORM;

use CarouselBundle\Entity\Carousel;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        //$admin->setName('admin');
        $admin->setEmail('admin@symfonyzero.es');
        $admin->setPlainPassword('admin');
        $admin->setRoles(['ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH']);
        $admin->setEnabled(true);

        $user = $userManager->createUser();
        $user->setUsername('user');
        //$user->setName('user');
        $user->setEmail('user@symfonyzero.es');
        $user->setPlainPassword('user');
        $user->setRoles(['ROLE_USER']);
        $user->setEnabled(true);

        $userManager->updateUser($admin);
        $userManager->updateUser($user);

        if(array_key_exists('CarouselBundle', $this->container->getParameter('kernel.bundles'))) {
            $carouselManager = $this->container->get('symfonyzero.carousel.manager');

            $carouselArray = [];
            for($i = 1; $i <= 3; $i++) {
                $carousel = $carouselManager->createCarousel();
                $carousel->setText('Text imagen #' . $i);
                $carousel->setImageName('Symfony' . $i . '.png');
                $carousel->setUpdatedAt(new \DateTime("now", new \DateTimeZone('UTC')));
                $carouselArray[] = $carousel;

            }

            $carouselManager->createEntities($carouselArray);
        }
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
