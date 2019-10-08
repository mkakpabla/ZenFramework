<?php

namespace Framework\Session;

class FlashService
{

    /**
     * @var SessionInterface
     */
    private $session;

    private $sessionKey = 'flash';

    private $messages;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Adds a flash message to the session for type.
     * @param string $type
     * @param string $message
     */
    public function set(string $type, string $message)
    {
        $flash = [];
        $flash[$type] = $message;
        $this->session->set($this->sessionKey, $flash);
    }

    /**
     * Get a flash message to the current session for type.
     * @param string $type
     * @return string|null
     */
    public function get(string $type): ?string
    {
        if (is_null($this->messages)) {
            $this->messages = $this->session->get($this->sessionKey, []);
            $this->session->delete($this->sessionKey);
        }
        if (array_key_exists($type, $this->messages)) {
            return $this->messages[$type];
        }
        return null;
    }
}
