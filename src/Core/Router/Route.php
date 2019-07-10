<?php


namespace Core\Router;


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
     * @var callable
     */
    private $handler;

    public function __construct(string $name, array $attributes, $handler)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->handler = $handler;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getHandler()
    {
        return $this->handler;
    }

}