<?php


namespace Framework\Session;

class Session implements SessionInterface
{

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->sessionStart();
        if ($_SESSION[$key]) {
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value): void
    {
        $this->sessionStart();
        $_SESSION[$key] = $value;
    }

    public function has($key)
    {
        $this->sessionStart();
        return isset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function delete(string $key): void
    {
        $this->sessionStart();
        unset($_SESSION[$key]);
    }

    private function sessionStart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
