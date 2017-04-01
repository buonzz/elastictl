<?php

namespace Buonzz\Elastictl\Commands\Indices;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Helper\Table;

use \Buonzz\Elastictl\ElasticSearch\IndexRepository;
use Buonzz\Elastictl\Transformers\Console\IndexTransformer;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class ListIndicesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('indices:list')
            ->setDescription('List Indices')
            ->addOption(
                'sort_by',
                null,
                InputOption::VALUE_REQUIRED,
                'Sort the indices by what field?',
                "name"
            )
            ->addOption(
                'exclude_hidden',
                null,
                InputOption::VALUE_REQUIRED,
                'Exclude indices that starts with period?',
                'yes'
            )->addOption(
                'style',
                null,
                InputOption::VALUE_REQUIRED,
                'What kind of styling of the table output?',
                'default'
            )->addOption(
                'namespace',
                null,
                InputOption::VALUE_REQUIRED,
                'Filter it by namespace',
                null
            );
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repo = new IndexRepository();
        $fractal = new Manager();
        $fractal->setSerializer(new ArraySerializer());

        $indices = $repo->all([
                        'sort_by' => $input->getOption('sort_by'),
                        'exclude_hidden' => $input->getOption('exclude_hidden'),
                        'namespace' => $input->getOption('namespace')
                    ]); 

        $resource = new Collection($indices->toArray(), new IndexTransformer);
        $transformed = $fractal->createData($resource)->toArray();

        $table = new Table($output);
        $table->setStyle($input->getOption('style'));
        $table
            ->setHeaders(array('Name', 'Documents', 'Size', 'Health'))
            ->setRows($transformed['data'])
        ;
        $table->render();
    }
}