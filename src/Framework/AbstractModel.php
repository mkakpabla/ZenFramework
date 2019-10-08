<?php


namespace Framework;

abstract class AbstractModel
{
    use Validator;

    protected $table;

    protected $rules = [];

    /*

    public function insert(array $inputs)
    {
        return $this->query
            ->insertInto($this->getTable())
            ->values($inputs)
            ->execute();
    }


    public function all()
    {
        return $this->query->from($this->getTable())
            ->fetchAll();
    }

    public function take(int $limit)
    {
        return $this->query
            ->from($this->getTable())
            ->limit($limit)
            ->fetch();
    }

    public function find(int $id)
    {
        return $this->query->from($this->getTable())
            ->where('id', $id)
            ->fetch();
    }

    public function get($key, $value)
    {
        return $this->query->from($this->getTable())
            ->where($key, $value)
            ->fetch();
    }

    public function delete(int $id)
    {
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
    } */
}
