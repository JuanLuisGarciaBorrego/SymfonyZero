<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private $google_id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function setExpiresAt(\DateTime $date = null)
    {
        parent::setExpiresAt($date);
    }
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
    public function setCredentialsExpireAt(\DateTime $date = null)
    {
        parent::setCredentialsExpireAt($date);
    }
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }
    
    public function getGoogleId()
    {
    	return $this->google_id;
    }
    
    public function setGoogleId($google_id)
    {
    	$this->google_id = $google_id;
    	return $this;
    }
}
