<?php


namespace App\Controllers\Admin;

use App\Entity\Post;
use App\Manager\CategoryManager;
use App\Manager\PostManager;
use Framework\Controller;
use Framework\Validator\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class PostsController
 * @package App\Controllers\Admin
 * @GroupRoute /admin/posts
 */
class PostsController extends Controller
{


    /**
     * @return string
     * @Route('get', '', 'admin.posts.index')
     */
    public function index()
    {
        $categories = $this->container->get(CategoryManager::class)->getAll();
        $posts = $this->container->get(PostManager::class)->getAll();
        return $this->render('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * @return string
     * @Route('get', '/create', 'admin.posts.create')
     */
    public function create()
    {
        $categories = $this->container->get(CategoryManager::class)->getAll();
        return $this->render('admin.posts.create', compact('categories'));
    }

    /**
     * @param ServerRequestInterface $request
     * @Route('post', '', 'admin.post.store')
     * @return string
     * @throws \Exception
     */
    public function store(ServerRequestInterface $request)
    {
        Validator::validate($request, Post::rules());
        $post = new Post();
        $post->setTitle($request->getParsedBody()['title'])
            ->setSlug($request->getParsedBody()['title'])
            ->setContent($request->getParsedBody()['content'])
            ->setCategoryId($request->getParsedBody()['category_id']);
        $this->container->get(PostManager::class)->create($post);
    }

    /**
     * @param $id
     * @return string
     * @Route('get', '/{id}/edit', 'admin.post.edit')
     */
    public function edit($id)
    {
        $post = $this->container->get(PostManager::class)->get('id', $id);
    }
}
