<?php


namespace Framework\Security;

interface AuthenticatableInterface
{

    public function getUsername(): string;


    public function getRole(): array;
}
