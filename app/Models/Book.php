<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model

{
    protected $fillable = ['title', 'slug', 'author', 'summary'];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }


}