<?php


namespace Components\Commands;


class Migrate extends \Phinx\Console\Command\Migrate
{

    protected function configure()
    {
        parent::configure(); // TODO: Change the autogenerated stub
        $this->setName('database:migrate');
    }
}