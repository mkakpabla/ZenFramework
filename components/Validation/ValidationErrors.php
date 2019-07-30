<?php
namespace Components\Validation;

/**
 * Class ValidatorErrors
 * @package Components\Validation
 */
class ValidationErrors implements \ArrayAccess
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

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}
