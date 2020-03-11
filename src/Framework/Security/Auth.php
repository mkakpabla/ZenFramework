<?php


namespace Framework\Security;

use Psr\Container\ContainerInterface;
use Framework\Databases\AbstractModel;
use Framework\Session\SessionInterface;
use Framework\Security\PasswordInterface;

class Auth
{

    private $guard;
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var PasswordInterface
     */
    private $password;

    /**
     * @var ContainerInterface
     */
    private $container;

    private $auth;

    private $model;


    public function __construct(ContainerInterface $container, string $guard = 'user')
    {
        $this->container = $container;
        $this->session = $container->get(SessionInterface::class);
        $this->password = $container->get(PasswordInterface::class);
        $this->guard = $guard;
        $this->model = $this->container->get('auth')[$guard];
    } 
    /**
     * @param array $credentials
     * @param string $guard
     */
    public function login(array $credentials): self
    {
        $credentialsKey = array_keys($credentials);
        $this->auth = $this->model->get($credentialsKey[0], $credentials[$credentialsKey[0]]);
        if ($this->auth && $this->password->verify($credentials['password'], $this->auth->password)) {
            $this->session->set($this->guard, $this->auth->id);
        }
        return $this;
    }

    public function logout(string $guard = 'user')
    {
        $this->session->delete($guard);
    }

    public function getUser(string $guard = 'user')
    {
        if ($this->auth) {
            return $this->auth;
        }
        $userId = $this->session->get($guard);
        if ($userId) {
            $this->auth = $this->model->find($userId);
            if ($this->auth) {
                return $this->auth;
            }
        }
        return null;
    }
}
