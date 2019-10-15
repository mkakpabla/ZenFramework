<?php


namespace Framework;

use Psr\Http\Message\ServerRequestInterface;
use Zen\Database\Query;
use Zen\Validation\UndifedRuleException;
use Zen\Validation\Validator;

abstract class AbstractModel
{

    protected $table;

    protected $rules = [];

    /**
     * @var Query
     */
    private $query;


    public function __construct(Query $query)
    {
        $this->query = $query;
    }



    public function insert(array $inputs)
    {
        return $this->query
            ->table($this->getTable())
            ->insert($inputs)
            ->execute();
    }


    public function all()
    {
        return $this->query
            ->table($this->getTable())
            ->select('*')
            ->fetchAll();
    }

    public function take(int $limit)
    {
        return $this->query
            ->table($this->getTable())
            ->select('*')
            ->limit($limit)
            ->fetchAll();
    }

    public function find(int $id)
    {
        return $this->query
            ->table($this->getTable())
            ->select('*')
            ->where(['id = ?' => $id])
            ->fetch();
    }

    public function get($key, $value)
    {
        return $this->query
            ->table($this->getTable())
            ->where(["$key = ?" => $value])
            ->select('*')
            ->fetch();
    }


    /***
     * Permet de faire la validation
     * @param ServerRequestInterface $request
     * @return void
     * @throws UndifedRuleException
     */
    public function validate(ServerRequestInterface $request)
    {
        $validator = (new Validator($request->getParsedBody(), $this->rules))
            ->validate();
        if (!$validator->isValid()){
            $uri = $request->getServerParams()['HTTP_REFERER'];
            header('Location: '. $uri);
            exit();
        }
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
