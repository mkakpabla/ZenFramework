<?php


namespace Framework\Security;

class Password implements PasswordInterface
{

    /**
     * Permet de crypter un mot de passe
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 12
        ]);
    }


    /***
     * Permet de vérifier un mot de passe crypté
     * @param string $password
     * @param string $hashPassword
     * @return bool
     */
    public function verify(string $password, string $hashPassword): bool
    {
        return password_verify($password, $hashPassword);
    }
}
