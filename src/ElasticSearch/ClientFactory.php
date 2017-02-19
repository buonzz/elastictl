<?php
namespace Buonzz\Elastictl\ElasticSearch;
use Monolog\Logger;
use Log;
use Elasticsearch\ClientBuilder;

class ClientFactory{

	 public static function getClient(){

        $hosts = [getenv('ES_HOST')];       
        $logging = getenv('ES_LOGGING');
        if($logging && is_writable(getenv('ES_LOGFILE')))
		{ 
       		$logger = ClientBuilder::defaultLogger( getenv('ES_LOGFILE'), Logger::INFO);
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