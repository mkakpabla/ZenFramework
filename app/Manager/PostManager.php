<?php


namespace App\Manager;

use App\Entity\Post;
use Framework\Manager;
use PDO;

class PostManager extends Manager
{


    public function create(Post $post)
    {
        $pdoStatement = $this->pdo->prepare("INSERT INTO posts 
                                               SET title = :title, slug = :slug,
                                               content = :content, category_id = :category_id");
        $pdoStatement->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':slug', $post->getSlug(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':content', $post->getContent(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':category_id', $post->getCategoryId());
        $exec = $pdoStatement->execute();
        if ($exec) {
            return $this->get('id', $this->pdo->lastInsertId());
        } else {
            return null;
        }
    }

    public function getAll()
    {
        $pdoStatement = $this->pdo->query("SELECT * FROM posts");
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, Post::class);
        return $pdoStatement->fetchAll();
    }

    public function get($key, $value)
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM posts WHERE $key = ?");
        $exec = $pdoStatement->execute([$value]);
        if ($exec) {
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, Post::class);
            $data = $pdoStatement->fetch();
            if ($data) {
                return $data;
            } else {
                return null;
            }
        } else {
            return false;
        }
    }
}
