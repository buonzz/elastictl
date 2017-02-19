<?php
namespace Buonzz\Elastictl;
use Monolog\Logger;
use Log;
use Elasticsearch\ClientBuilder;

class ClientFactory{

	 public static function getClient(){

        $hosts = getenv('HOST');       
        $logging = getenv('LOGGING');
        if($logging)
		{ 
       		$logger = ClientBuilder::defaultLogger( getenv('LOGFILE'), Logger::INFO);
        	$client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                	->setHosts($hosts)      // Set the hosts
                	->setLogger($logger)
                	->build();              // Build the client object
		}
		else
		{
        	$client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                	->setHosts($hosts)      // Set the hosts
                	->build();              // Build the client object			
		}
         return $client;
	} // get client
} // factory}