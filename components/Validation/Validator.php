<?php
namespace Components\Validation;

/**
 * Class Validator
 * @package Components\Validation
 */
class Validator
{


    /**
     * @var array
     */
    private $datas = [];

    /**
     * @var
     */
    private $validate;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * Validator constructor.
     * @param array $datas
     * @param string $validate
     */
    public function __construct(array $datas, string $validate)
    {
        foreach ($datas as $key => $data) {
            $this->datas[$key] = $data;
        }
        $this->validate = new $validate();
    }

    /**
     * @return $this
     */
    public function make(): self
    {
        foreach ($this->validate->rules() as $key => $rule) {
            $rules = explode('|', $rule);
            if (in_array('required', $rules)) {
                $this->required($key, 'required');
            }
            if (in_array('notEmpty', $rules)) {
                $this->notEmpty($key, 'notEmpty');
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /***
     * Vérifie si le champ existe
     * @param string $key
     * @param string $rule
     */
    private function required(string $key, string $rule): void
    {
        $value = $this->getValue($key);
        if (is_null($value)) {
            $this->addError($key, 'required');
        }
    }

    /**
     * @param string $key
     * @param string $rule
     */
    private function notEmpty(string $key, string $rule)
    {
        $value = $this->getValue($key);
        if (is_null($value) || empty($value)) {
            $this->addError($key, $rule);
        }
    }


    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return empty($this->errors);
    }

    /**
     * @param string $key
     * @param string $rule
     */
    private function addError(string $key, string $rule)
    {
        if (!array_key_exists($key, $this->errors)) {
            $this->errors[$key] = new ValidatorErrors($key, $rule, $this->validate->messages());
        }
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    private function getValue(string $key)
    {
        if (array_key_exists($key, $this->datas)) {
            return $this->datas[$key];
        }
        return null;
    }
}
