<?php
namespace Components;

use PDO;

/**
 * Class Database
 * @package App\Database
 */
class Database
{
    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=zen', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }
}
