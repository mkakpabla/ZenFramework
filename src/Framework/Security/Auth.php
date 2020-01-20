<?php


namespace Framework\Security;

use Zen\Database\Query;
use Psr\Container\ContainerInterface;
use Framework\Databases\AbstractModel;
use Framework\Session\SessionInterface;

class Auth extends AbstractModel
{

    protected $guard = 'user';
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var PasswordInerface
     */
    private $password;

    private $auth;

    
    /**
     * @param array $credentials
     * @param string $redirectRoute
     */
    public function login(array $credentials, string $redirectRoute)
    {
        $credentialsKey = array_keys($credentials);
        $this->auth = $this->get($credentialsKey[0], $credentials[$credentialsKey[0]]);
        if ($this->auth && $this->password->verify($credentials['password'], $this->auth->password)) {
            $this->session->set($this->guard, $this->auth->id);
            return $this->auth;
        }
        return null;
    }

    public function logout()
    {
        $this->session->delete($this->guard);
    }

    public function getUser()
    {
        if ($this->auth) {
            return $this->auth;
        }
        $userId = $this->session->get($this->guard);
        if ($userId) {
            $this->auth = $this->find($userId);
            if ($this->auth) {
                return $this->auth;
            }
        }
        return null;
    }
}
