<?php


use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use Buonzz\Elastictl\Commands\ClusterInfoCommand;

class HelloCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new ClusterInfoCommand());

        $command = $application->find('cluster:info');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    }
}