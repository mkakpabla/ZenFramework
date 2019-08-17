<?php


namespace App\Entity;

use Framework\Helpers\EntityValidator;

/**
 * Class Post
 * @package App\Entity
 */
class Post
{
    use EntityValidator;

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     * @Rule 'required'
     */
    private $title;
    /**
     * @var string
     * @Rule 'required'
     */
    private $slug;
    /**
     * @var string
     * @Rule 'required'
     */
    private $content;
    /**
     * @var int
     * @Rule 'required|integer'
     */
    private $category_id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Post
     */
    public function setSlug(string $slug): Post
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param $category_id
     * @return Post
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }
}
