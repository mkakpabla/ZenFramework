<?php
namespace App\Controllers;

use Framework\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class PregReplace extends AbstractController
{

    /**
     * @Route('get', '/posts', 'posts.index')
     */
    public function index()
    {
        //
    }

    /**
     * @Route('post', '/posts/create', 'posts.store')
     * @param ServerRequestInterface $request
     */
    public function create(ServerRequestInterface $request)
    {
        //
    }

    /**
     * @Route('post', '/posts', 'posts.store')
     * @param ServerRequestInterface $request
     */
    public function store(ServerRequestInterface $request)
    {
        //
    }


    /**
     * @Route('get', '/posts/{id}', 'posts.show')
     * @param $id
     */
    public function show($id)
    {
        //
    }
}
