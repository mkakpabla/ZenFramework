<?php
namespace App\Controllers\Admin;

use App\Models\Category;
use Framework\Controller;
use Psr\Http\Message\ServerRequestInterface;

class CategoriesController extends Controller
{

    /**
     * @param ServerRequestInterface $request
     * @return string
     * @Route('get', '/admin/categories', 'admin.categories.index')
     */
    public function index(ServerRequestInterface $request)
    {
        $categories = $this->container->get(Category::class)->all();
        return $this->render('admin.categories.index', compact('categories'));
    }
}
