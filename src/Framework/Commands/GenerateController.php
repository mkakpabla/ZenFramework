<?php

namespace Framework\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateController extends Command
{
    protected function configure()
    {
        $this->setName('make:controller');
        $this->addArgument("name", InputArgument::REQUIRED, 'controller name');
        $this->addArgument("route", InputArgument::OPTIONAL, 'controller route base name');
        $this->setDescription('Create a new controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $route = $input->getArgument('route');
        if ($route) {
            $text = file_get_contents(__DIR__ . '/templates/controller.routes.template.php');
            file_put_contents(
                getcwd() . '/app/Controllers/' .$name.'.php',
                preg_replace(['/PregReplace/', '/baseroute/'], [$name, $route], $text)
            );
        } else {
            $text = file_get_contents(__DIR__ . '/templates/controller.template.php');
            file_put_contents(
                getcwd() . '/app/Controllers/' .$name.'.php',
                preg_replace('/PregReplace/', $name, $text)
            );
        }
        
        $output->writeln("Controller généré");
    }
}
