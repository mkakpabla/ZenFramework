<?php
namespace Framework\Factory;

use Psr\Container\ContainerInterface;
use Swift_SmtpTransport;

class SwiftMailerFactory
{


    public function __invoke(ContainerInterface $container)
    {
        $mail = (object)$container->get('mail');
        // Create the Transport
        $transport = (new Swift_SmtpTransport($mail->host, $mail->port))
            ->setUsername($mail->username)
            ->setPassword($mail->password)
        ;
        return new \Swift_Mailer($transport);
    }

}
