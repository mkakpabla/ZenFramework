<?php


namespace App\Manager;

use App\Entity\User;
use Components\Manager;
use PDO;

class UserManager extends Manager
{


    public function getAll()
    {
        //
    }

    public function get(int $id)
    {
        //
    }

    public function create(User $user): int
    {
        $pdoStatment = $this->pdo->prepare(
            "INSERT INTO users
                    SET  email = :email, username = :username, password = :password"
        );
        $pdoStatment->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $pdoStatment->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $pdoStatment->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        return $pdoStatment->execute();
    }

    public function update(User $user, int $id)
    {
        //
    }

    public function delete($entity)
    {
        //
    }
}
