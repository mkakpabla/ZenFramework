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
        $pdoStatement = $this->pdo->prepare(
            "SELECT * FROM users WHERE id = :id"
        );
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetch();
    }

    public function create(User $user): bool
    {
        $pdoStatement = $this->pdo->prepare(
            "INSERT INTO users
                    SET  email = :email, username = :username, password = :password"
        );
        $pdoStatement->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        return $pdoStatement->execute();
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
