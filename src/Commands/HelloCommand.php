<?php

namespace Buonzz\Elastictl\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class HelloCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('hello')
            ->setDescription('Sample hello command');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Hello");
    }
}