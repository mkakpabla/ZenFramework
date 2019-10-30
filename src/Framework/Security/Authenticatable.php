<?php


namespace Framework\Security;

use Framework\AbstractModel;
use Framework\Session\SessionInterface;
use Zen\Database\Query;

class Authenticatable extends AbstractModel implements AuthenticatableInterface
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


    public function __construct(Query $query, SessionInterface $session, PasswordInerface $password)
    {
        parent::__construct($query);
        $this->session = $session;
        $this->password = $password;
    }

    public function login(array $credentials)
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
