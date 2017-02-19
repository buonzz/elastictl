<?php

namespace Buonzz\Elastictl\Commands\Indices;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Buonzz\Elastictl\ClientFactory;

class ListIndicesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('indices:list')
            ->setDescription('List Indices');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = ClientFactory::getClient(); 
        $response = $client->indices()->status();

        var_dump($response);

    }
}