<?php


namespace Framework;

use App\Models\Post;
use Framework\Database\Query;
use PDO;

abstract class AbstractModel
{

    protected $table;

    protected $rules = [];



    public function insert(array $inputs)
    {
    }


    public function all()
    {
        return (new Query())
            ->from($this->getTable())
            ->into(get_class($this))
            ->fetchAll();
    }

    public function take(int $limit)
    {
        return (new Query())
            ->from($this->getTable())
            ->limit($limit)
            ->into(get_class($this))
            ->fetch();
    }

    public function get(array $key)
    {
        return (new Query())
            ->from($this->getTable())
            ->where($key)
            ->into(get_class($this))
            ->fetch();
    }

    public function delete(int $id)
    {
    }



    private function getInputsKeys(array $inputs)
    {
        return implode(' = ?, ', array_keys($inputs)) . ' = ?';
    }

    private function getTable()
    {
        if (!$this->table) {
            $pieces = explode('\\', get_class($this));
            $modelName = end($pieces);
            $table = strtolower($modelName) . 's';
            return $table;
        }
        return $this->table;
    }
}
