<?php


namespace Framework\Factory;

use Envms\FluentPDO\Query;

class QueryFactory
{

    public function __invoke(\PDO $pdo)
    {
        return new Query($pdo);
    }
}
