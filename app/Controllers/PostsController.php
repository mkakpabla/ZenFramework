<?php
namespace App\Controllers;

use App\Models\Post;
use Framework\Controller;

class PostsController extends Controller
{

    /**
     * @Route('get', '/posts', 'posts.index')
     */
    public function index()
    {
        $posts = $this->container->get(Post::class)->all();
        return $this->render('posts.index', compact('posts'));
    }
    /**
     * @Route('get', '/posts/{slug}', 'posts.show')
     * @param $slug
     * @return string
     * @throws \Exception
     */
    public function show($slug)
    {
        $post = $this->container->get(Post::class)->get('slug', $slug);
        return $this->render('posts.show', compact('post'));
    }
}
