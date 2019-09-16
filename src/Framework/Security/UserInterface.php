<?php


namespace Framework\Security;

interface UserInterface
{

    public function getUsername(): string;


    public function getRole(): array;
}
