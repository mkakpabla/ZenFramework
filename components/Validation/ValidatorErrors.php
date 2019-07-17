<?php
namespace Components\Validation;

/**
 * Class ValidatorErrors
 * @package Components\Validation
 */
class ValidatorErrors
{

    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $rule;
    /**
     * @var array
     */
    private $messages;

    /**
     * ValidatorErrors constructor.
     * @param string $key
     * @param string $rule
     * @param array $messages
     */
    public function __construct(string $key, string $rule, array $messages)
    {
        $this->key = $key;
        $this->rule = $rule;
        $this->messages = $messages;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getMessage($this->key, $this->rule);
    }

    /**
     * @param string $key
     * @param string $rule
     * @return mixed
     */
    private function getMessage(string $key, string $rule)
    {
        return $this->messages[$key.'.'.$rule];
    }
}
