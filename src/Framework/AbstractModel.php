<?php


namespace Framework;

use PDO;

abstract class AbstractModel
{

    protected $table;

    protected $rules = [];

    /**
     * @var PDO
     */
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function insert(array $inputs)
    {
        $sql = "INSERT INTO {$this->table} SET {$this->getInputsKeys($inputs)}";
        $pdoStmt = $this->pdo->prepare($sql);
        return $pdoStmt->execute(array_values($inputs));
    }


    public function all()
    {
        $pdoStmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $pdoStmt->execute();
        return $pdoStmt->fetchAll();
    }

    public function delete(int $id)
    {
        $pdoStmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $pdoStmt->execute([$id]);
    }



    private function getInputsKeys(array $inputs)
    {
        $col = '';
        $array = array_keys($inputs);
        $last_key = end($array);
        foreach ($inputs as $key => $input) {
            if ($key === $last_key) {
                $col .= ' '. $key . ' = ?';
            } else {
                $col .= ' '. $key . ' = ?,';
            }
        }
        return $col;
    }
}
