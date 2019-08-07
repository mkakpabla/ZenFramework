<?php


namespace Framework\Auth;

/**
 * Interface AuthInterface
 * @package Framework\Auth
 */
interface AuthInterface
{

    /***
     * @return Authentifiable
     */
    public function getAuth(): ?Authentifiable;


    /**
     * @return array
     */
    public function getRoles(): array;
}
