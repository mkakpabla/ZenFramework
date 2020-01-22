<?php


namespace App\Models;

use Framework\Databases\AbstractModel;

class User extends AbstractModel
{

    protected $table = 'users';

    protected $rules = [
        'username' => 'notEmpty'
    ];
}
