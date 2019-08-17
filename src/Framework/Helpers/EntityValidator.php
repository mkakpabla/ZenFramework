<?php


namespace Framework\Helpers;

use Framework\Validator\EntityRulesReader;

trait EntityValidator
{

    public static function rules(): array
    {
        $reader = new EntityRulesReader(__CLASS__);
        $reader->run();
        return $reader->getRules();
    }
}
