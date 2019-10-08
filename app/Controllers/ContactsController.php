<?php


namespace App\Controllers;

use App\Models\Category;
use Framework\AbstractController;
use GuzzleHttp\Psr7\MessageTrait;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Swift_Mailer;
use Swift_Message;
use Zen\Validation\UndifedRuleException;

class ContactsController extends AbstractController
{


    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @Route('get', '/contacts', 'contacts')
     */
    public function create()
    {
        return $this->render('contacts');
    }

    /**
     * @Route('post', '/contacts', 'contacts.store')
     * @param ServerRequestInterface $request
     * @param Swift_Mailer $mailer
     * @return MessageTrait|Response
     * @throws UndifedRuleException
     */
    public function store(ServerRequestInterface $request, Swift_Mailer $mailer)
    {
        $this->category->validate($request);
        $message = (new Swift_Message($request->getParsedBody()['subjet']))
            ->setFrom([$request->getParsedBody()['email'] => $request->getParsedBody()['name']])
            ->setTo(['contact@zen.org'])
            ->setBody(
                $this->renderView(
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
