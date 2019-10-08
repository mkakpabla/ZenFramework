<?php


namespace Framework\Router;

use Exception;

/**
 * Représente une route
 * Class Route
 * @package Core\Router
 */
class Route
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $attributes;

    /***
     * @var callable | string
     */
    private $handler;

    /**
     * Route constructor.
     * @param string $name
     * @param array $attributes
     * @param callable|string $handler
     */
    public function __construct(string $name, array $attributes, $handler)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return callable|array
     */
    public function getHandler()
    {
        if (is_string($this->handler)) {
            try {
                $target = explode('#', $this->handler);
                $controller = $target[0];
                $action = $target[1];
            } catch (Exception $e) {
                return $e->getMessage();
            }
            return [
                'controller' => $controller,
                'method' => $action
            ];
        }
        return $this->handler;
    }
}
