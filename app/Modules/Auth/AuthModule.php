<?php


namespace App\Modules\Auth;


use App\Modules\Auth\Actions\AccountAction;
use App\Modules\Auth\Actions\LoginAction;
use App\Modules\Auth\Actions\RegisterAction;
use Framework\Router\Router;

class AuthModule
{

    public function __construct(Router $router)
    {
        $router->addAction(LoginAction::class);
        $router->addAction(RegisterAction::class);
        $router->addAction(AccountAction::class);
    }

}