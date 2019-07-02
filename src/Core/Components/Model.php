<?php

namespace Core;

class Model
{


    protected $table = __CLASS__;

    public function __construct()
    {

    }

    protected function getTable()
    {
        return end(explode('\\',$this->table));
    }
}