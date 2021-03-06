<?php

namespace Buonzz\Elastictl\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Buonzz\Elastictl\ElasticSearch\ClientFactory;

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

        $output->writeln("<comment>Host:</comment> " . getenv("ES_HOST"));
        $output->writeln("<comment>Cluster Name:</comment> " . $response['cluster_name']);
        $output->writeln("<comment>Status:</comment> " . $response['status']);
        $output->writeln("<comment>Indices Count:</comment> " . number_format($response['indices']['count']));        
        $output->writeln("<comment>Documents Count:</comment> " . number_format($response['indices']['docs']['count']));
        $output->writeln("<comment>Nodes Count:</comment> " . $response['nodes']['count']['total']);
        $output->writeln("<comment>Versions:</comment> " 
                    . implode(",", $response['nodes']['versions'])
                );
    }
}