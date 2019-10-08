<?php

namespace App\Controllers;

use Framework\AbstractController;
use Swift_Mailer;
use Swift_Message;

class HomeController extends AbstractController
{


    /**
     * @Route('get', '/', 'home')
     * @param Swift_Mailer $mailer
     * @return string
     */
    public function index(Swift_Mailer $mailer)
    {
        // Create a message
        /*
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
            ->setBody(
                $this->renderView(
                    'emails.text',
                    ['name' => 'michel']
                ),
                'text/html'
            );
        $mailer->send($message);*/
        return $this->render('welcome');
    }
}
