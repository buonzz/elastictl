<?php

namespace Buonzz\Elastictl\Commands\Indices;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Helper\Table;

use \Buonzz\Elastictl\ElasticSearch\IndexRepository;

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
        $repo = new IndexRepository();
        $indices = $repo->all(); 

        $table = new Table($output);
        $table
            ->setHeaders(array('Name', 'Documents', 'Size', 'Health'))
            ->setRows($indices->toArray())
        ;
        $table->render();
    }
}