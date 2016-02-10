<?php

namespace AppBundle\Services;

use Swift_Mailer;
use Symfony\Bundle\TwigBundle\TwigEngine;

/*
 * Mail sender from any part of the application
 */
Class Email {
    private $mailer;
    private $templating;
    
    /**
    * Constructor
    */
    
    public function __construct(Swift_Mailer $mailer, TwigEngine $templating) {
        $this->mailer = $mailer;
        $this->templating = $templating;
    } 
    
    public function sendEmail($subject, $from, $to, $template, $params){                
        $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($from => 'SymfonyZero'))
                    ->setTo($to)                   
                    ->setBody(
                        $this->templating->render($template, $params),'text/html');            
            $this->mailer->send($message);            
    }
}