<?php


namespace App\Models;

use Framework\AbstractModel;

class Category extends AbstractModel
{

    protected $table = 'categories';

    protected $rules = [
        'name' => 'required|notEmpty'
    ];
}
