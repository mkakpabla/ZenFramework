<?php
namespace App\Controllers;

use App\Entity\Post;
use App\Manager\PostManager;
use Framework\Controller;

class PostsController extends Controller
{

    /**
     * @Route('get', '/posts/{slug}', 'post.show')
     * @param $slug
     * @return string
     */
    public function show($slug)
    {
        $post = $this->container->get(PostManager::class)->get('slug', $slug);
        return $this->render('posts.show', compact('post'));
    }

    /**
     * @Route('get', '/posts', 'posts.index')
     */
    public function index()
    {
        $posts = $this->container->get(PostManager::class)->getAll();
        return $this->render('posts.index', compact('posts'));
    }
}
