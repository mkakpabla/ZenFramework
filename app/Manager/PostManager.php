<?php


namespace App\Manager;

use App\Entity\Post;
use Framework\Manager;

class PostManager extends Manager
{

    public function getAll()
    {
        $pdoStatement = $this->pdo->query("SELECT * FROM posts");
        return $pdoStatement->fetchAll();
    }

    public function get($key, $value)
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM posts WHERE $key = ?");
        $pdoStatement->execute([$value]);
        return $pdoStatement->fetch();
    }
}
