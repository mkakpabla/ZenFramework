<?php
namespace App\Database;


use PDO;

/**
 * Class MysqlDatabase
 * @package App\Database
 */
class MysqlDatabase
{


    /**
     * @var string
     */
    private $db_host;
    /**
     * @var string
     */
    private $db_name;
    /**
     * @var string
     */
    private $db_user;
    /**
     * @var string
     */
    private $db_password;

    /**
     * @var
     */
    private $pdo;

    /**
     * MysqlDatabase constructor.
     * @param string $db_host
     * @param string $db_name
     * @param string $db_user
     * @param string $db_password
     */
    public function __construct(string $db_host, string $db_name, string $db_user, string $db_password)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
    }

    /**
     * @return PDO
     */
    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_user,$this->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }
}