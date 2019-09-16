<?php


namespace App\Models;

use Framework\AbstractModel;

class Post extends AbstractModel
{

    protected $table = 'posts';


    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title . 'test';
    }

    /**
     * @param mixed $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}
