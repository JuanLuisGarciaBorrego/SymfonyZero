<?php

namespace AppBundle\Services;

use Swift_Mailer;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Mail sender from any part of the application.
 */
class Email
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @var string mailer_user
     *             #parameters.yml
     */
    private $email;

    /**
     * Email constructor.
     *
     * @param Swift_Mailer $mailer
     * @param TwigEngine   $templating
     */
    public function __construct(Swift_Mailer $mailer, TwigEngine $templating, $email)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->email = $email;
    }

    /**
     * @param $subject
     * @param null $from
     * @param $to
     * @param $template
     * @param $params
     */
    public function sendEmail($subject, $from = null, $to, $template, $params = null)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom(($from) ? $from : $this->email)
            ->setTo($to)
            ->setBody(
                $this->templating->render($template, [$params]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
