<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Models\Post;
use Framework\Controller;

class PostsController extends Controller
{

    /**
     * @Route('get', '/posts/{slug}', 'posts.show')
     * @param $slug
     * @return string
     */
    public function show($slug)
    {
        $post = $this->container->get(PostManager::class)->get('slug', $slug);
        if ($post === null) {
            return $this->notFound();
        }
        return $this->render('posts.show', compact('post'));
    }

    /**
     * @Route('get', '/posts', 'posts.index')
     */
    public function index()
    {
        $posts = $this->container->get(Post::class)->all();
        dd($posts);
        return $this->render('posts.index', compact('posts'));
    }
}
