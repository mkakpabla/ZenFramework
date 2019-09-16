<?php


namespace Framework\Session;

/**
 * Interface SessionInterface
 * @package Components\Session
 */
interface SessionInterface
{

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);


    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value): void;


    /**
     * @param string $key
     * @return mixed
     */
    public function delete(string $key): void;



    public function has(string $key);
}
