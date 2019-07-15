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
     * Database constructor.
     * @param array $databaseConfig
     */
    public function __construct(array $databaseConfig)
    {
        $this->db_host = $databaseConfig['host'];
        $this->db_name = $databaseConfig['Database'];
        $this->db_user = $databaseConfig['username'];
        $this->db_password = $databaseConfig['password'];
    }

    /**
     * @return PDO
     */
    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }
}
