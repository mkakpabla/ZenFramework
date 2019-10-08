<?php
namespace Framework\Session;

interface SessionInterface
{


    /***
     * Verifie si la clé existe
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Récupère une information en Session
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Ajoute une information en Session
     *
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value): void;

    /**
     * Supprime une clef en session
     * @param string $key
     */
    public function delete(string $key): void;
}
