<?php

namespace Framework\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateModel extends Command
{
    protected function configure()
    {
        $this->setName('make:model');
        $this->addArgument("name", InputArgument::REQUIRED, 'Nom du model');
        $this->setDescription('Create a new model');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $text = file_get_contents(__DIR__ . '/templates/model.template.php');
        file_put_contents(
            getcwd() . '/app/Entity/' .$name.'.php',
            preg_replace('/PregReplace/', "$name", $text)
        );
        $output->writeln("Model généré");
    }
}
