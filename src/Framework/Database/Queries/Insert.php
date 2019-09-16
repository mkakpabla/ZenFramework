<?php


namespace Framework\Database\Queries;

use Framework\Database\Query;

class Insert
{

    /**
     * @var Query
     */
    private $query;
    private $table;
    /**
     * @var array
     */
    private $inputs;

    public function __construct(Query $query, string $table, array $inputs)
    {
        $this->query = $query;
        $this->table = $table;
        $this->inputs = $inputs;
    }

    public function execute()
    {
        $query = $this->__toString();
        $statement = $this->query->pdo->prepare($query);
        $statement->execute(array_values($this->inputs));
        return $this->query->pdo->lastInsertId();
    }

    public function __toString()
    {
        $parts = ['INSERT INTO'];
        if ($this->table) {
            $parts[] = $this->table;
        }
        $parts[] = 'SET';
        if ($this->inputs) {
            $parts[] = $this->getInputsKeys();
        }
        return join(' ', $parts);
    }


    private function getInputsKeys()
    {
        return implode(' = ?, ', array_keys($this->inputs)) . ' = ?';
    }
}
