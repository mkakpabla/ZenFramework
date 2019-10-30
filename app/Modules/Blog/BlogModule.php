<?php


namespace App\Modules\Blog;


use App\Modules\Blog\Actions\HomeAction;
use App\Modules\Blog\Actions\PostsAction;
use Framework\Router\Router;

class BlogModule
{

    protected $routes = [];

    public function __construct(Router $router)
    {
        $router->addAction(HomeAction::class);
        $router->addAction(PostsAction::class);
    }

}