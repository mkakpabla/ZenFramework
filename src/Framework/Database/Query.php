<?php

namespace Framework\Database;

use Framework\Database\Queries\Insert;
use Framework\Database\Queries\Select;
use Framework\Database\Queries\Update;
use Framework\Env;
use PDO;

class Query
{

    /**
     * @var string
     */
    private $table;

    /**
     * @var PDO
     */
    public $pdo;


    public function __construct(PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }


    /**
     * Definit la table
     * @param string $table
     * @param null|string $alias
     * @return Query
     */
    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(string ...$columns)
    {
        return new Select($this, $this->table, $columns);
    }

    public function insert(array $inputs)
    {
        return new Insert($this, $this->table, $inputs);
    }

    public function update(array $inputs)
    {
        return new Update($this, $this->table, $inputs);
    }
}
