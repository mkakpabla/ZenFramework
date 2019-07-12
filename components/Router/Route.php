<?php


namespace Components\Router;


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
     * @return callable|string
     */
    public function getHandler()
    {
        if (is_string($this->handler)) {
            $target = explode('#', $this->handler);
            $controller = new $target[0]();
            $action = $target[1];
            return [$controller, $action];
        }

        return $this->handler;
    }

}