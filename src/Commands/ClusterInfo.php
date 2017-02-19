<?php

namespace Buonzz\Elastictl\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Buonzz\Elastictl\ClientFactory;

class ClusterInfoCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('cluster:info')
            ->setDescription('Get cluster info');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $client = ClientFactory::getClient(); 
        $response = $client->cluster()->stats();
        $output->writeln($response);
    }
}