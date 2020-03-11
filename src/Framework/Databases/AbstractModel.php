<?php


namespace Framework\Databases;

use App\Models\User;
use Zen\Validation\Validator;
use Zen\Validation\UndifedRuleException;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractModel
{

    protected $table;

    protected $rules = [];


    public function __get(string $name)
    {
        return $this->$name;
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
        return DB::query()
            ->table($this->getTable())
            ->select('*')
            ->into(get_class($this))
            ->fetchAll();
    }

    public function take(int $limit)
    {
        return DB::query()
            ->table($this->getTable())
            ->select('*')
            ->limit($limit)
            ->fetchAll();
    }

    public function find(int $id)
    {
        return DB::query()
            ->table($this->getTable())
            ->select('*')
            ->where(['id = ?' => $id])
            ->into(get_class($this))
            ->fetch();
    }

    public function get($key, $value)
    {
        return DB::query()
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
        if (!$validator->isValid()) {
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
