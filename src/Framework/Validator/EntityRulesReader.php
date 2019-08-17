<?php


namespace Framework\Validator;

class EntityRulesReader
{

    private $entity;

    private $rules = [];

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function run()
    {
        $reflectionClass = new \ReflectionClass($this->entity);
        foreach ($reflectionClass->getProperties() as $property) {
            $preg = preg_match_all(
                "/@Rule\s+(['|a-zA-Z]+)/i",
                $property->getDocComment(),
                $matches
            );
            if ($preg) {
                $this->rules[$property->name] = trim($matches[1][0], "'");
            }
        }
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
