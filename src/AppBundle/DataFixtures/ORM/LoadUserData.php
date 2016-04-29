<?php

namespace AppBundle\DataFixtures\ORM;

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
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        $admin->setEmail('admin@symfonyzero.es');
        $admin->setPlainPassword('admin');
        $admin->setRoles(['ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH']);
        $admin->setEnabled(true);

        $user = $userManager->createUser();
        $user->setUsername('user');
        $user->setEmail('user@symfonyzero.es');
        $user->setPlainPassword('user');
        $user->setRoles(['ROLE_USER']);
        $user->setEnabled(true);

        $userManager->updateUser($admin);
        $userManager->updateUser($user);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}