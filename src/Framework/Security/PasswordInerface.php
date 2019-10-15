<?php


namespace Framework\Security;


interface PasswordInerface
{


    public function hash(string $password): string;


    public function verify(string $password, string $hashPassword): bool;
}