<?php
namespace App\Controllers;

use App\Models\Post;
use Exception;
use Framework\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class PostsController extends AbstractController
{

    /**
     * @Route('get', '/posts', 'posts.index')
     */
    public function index()
    {
        return $this->render('posts.index');
    }

    /**
     * @Route('post', '/posts', 'posts.store')
     * @param ServerRequestInterface $request
     */
    public function store(ServerRequestInterface $request)
    {
    }


    /**
     * @Route('get', '/posts/{slug}', 'posts.show')
     * @param $slug
     * @return string
     * @throws Exception
     */
    public function show($slug)
    {
        return $this->render('posts.show');
    }
}
