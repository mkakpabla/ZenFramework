<?php


namespace App\Controllers;

use Framework\AbstractController;
use Psr\Http\Message\ServerRequestInterface;
use Swift_Message;

class ContactsController extends AbstractController
{


    /**
     * @Route('get', '/contacts', 'contacts')
     */
    public function create()
    {
        return $this->render('contacts');
    }

    /**
     * @Route('post', '/contacts', 'contacts.store')
     */
    public function store(ServerRequestInterface $request, \Swift_Mailer $mailer)
    {
        $message = (new Swift_Message($request->getParsedBody()['subjet']))
            ->setFrom([$request->getParsedBody()['email'] => $request->getParsedBody()['name']])
            ->setTo(['contact@zen.org'])
            ->setBody(
                $this->render(
                    'emails.contacts',
                    $request->getParsedBody()
                ),
                'text/html'
            );
        $mailer->send($message);
        $this->addFlash('success', 'Votre email à été envoyer');
        return $this->redirect('contacts');
    }



}
