<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    
    public function setExpiresAt(\DateTime $date = null) {
        parent::setExpiresAt($date);
    }
    public function getExpiresAt(){
        return $this->expiresAt;
    }
    public function setCredentialsExpireAt(\DateTime $date = null) {
        parent::setCredentialsExpireAt($date);
    }
    public function getCredentialsExpireAt(){
        return $this->credentialsExpireAt;
    }
}