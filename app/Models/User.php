<?php


namespace App\Models;

use Framework\Security\Auth;
use Framework\Databases\AbstractModel;

class User extends Auth
{

    protected $table = 'users';

    protected $rules = [
        'username' => 'notEmpty'
    ];
}
