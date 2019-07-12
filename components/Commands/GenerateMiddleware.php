<?php

namespace Components\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateMiddleware extends Command
{
    protected function configure()
    {
        $this->setName('make:middleware');
        $this->addArgument("name", InputArgument::REQUIRED, 'Nom du middleware');
        $this->setDescription('Génère une classe middleware');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $text = file_get_contents(__DIR__ . '/templates/middleware.template.php');
        file_put_contents(dirname(dirname(__DIR__)) . '/app/Middlewares/' .$name.'.php', preg_replace('/PregReplace/', "$name", $text));
        $output->writeln("Middleware généré");
    }

}
