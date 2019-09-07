<?php


namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
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
        $categories = $this->container->get(Category::class)->all();
        $posts = $this->container->get(Post::class)->all();
        return $this->render('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * @return string
     * @Route('get', '/create', 'admin.posts.create')
     */
    public function create()
    {
        $categories = $this->container->get(Category::class)->all();
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
        $this->container->get(Post::class)->insert($request->getParsedBody());
        return $this->redirect('admin.posts.index');
    }

    /**
     * @param $id
     * @return string
     * @Route('get', '/{id}/edit', 'admin.post.edit')
     */
    public function edit($id)
    {
        $post = $this->container->get(Post::class)->get('id', $id);
    }

    /**
     * @param $id
     * @return string
     * @Route('get', '/{id}/delete', 'admin.post.delete')
     */
    public function delete($id)
    {
        $this->container->get(Post::class)->delete($id);
        return $this->redirect('admin.posts.index');
    }
}
