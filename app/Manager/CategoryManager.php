<?php


namespace App\Manager;

use App\Entity\Category;
use Framework\Manager;
use PDO;

class CategoryManager extends Manager
{

    public function getAll()
    {
        $pdoStatement = $this->pdo->query("SELECT * FROM categories");
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, Category::class);
        return $pdoStatement->fetchAll();
    }
}
