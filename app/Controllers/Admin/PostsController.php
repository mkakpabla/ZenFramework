<?php


namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Framework\Controller;
use Psr\Http\Message\ServerRequestInterface;

class PostsController extends Controller
{


    /**
     * @Route('get', '/admin/posts', 'admin.posts.index')
     */
    public function index()
    {
        $categories = $this->container->get(Category::class)->all();
        $posts = $this->container->get(Post::class)->all();
        return $this->render('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * @return string
     * @Route('get', '/admin/posts/create', 'admin.posts.create')
     */
    public function create()
    {
        $categories = $this->container->get(Category::class)->all();
        return $this->render('admin.posts.create', compact('categories'));
    }

    /**
     * @param ServerRequestInterface $request
     * @Route('post', ''/admin/posts/create'', 'admin.post.store')
     * @return string
     * @throws \Exception
     */
    public function store(ServerRequestInterface $request)
    {
        $data = array_merge($request->getParsedBody(), [
            'cover' => 'test'
        ]);
        $this->container->get(Post::class)->insert($data);
        return $this->redirect('admin.posts.index');
    }

    /**
     * @param $id
     * @return string
     * @Route('get', '/{id}/edit', 'admin.post.edit')
     * @throws \Exception
     */
    public function edit($id)
    {
        $post = $this->container->get(Post::class)->get('id', $id);
    }

    /**
     * @param $id
     * @return string
     * @Route('get', '/{id}/delete', 'admin.post.delete')
     * @throws \Exception
     */
    public function delete($id)
    {
        $post = $this->container->get(Post::class)->get(['id' => $id]);
        $upload = new PostsUpload();
        $upload->delete($post->cover);
        $this->container->get(Post::class)->delete($id);
        return $this->redirect('admin.posts.index');
    }
}
