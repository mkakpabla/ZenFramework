<?php


namespace Framework\Security;

interface AuthenticatableInterface
{


    public function login(array $credentials);

    public function getUser();
}
