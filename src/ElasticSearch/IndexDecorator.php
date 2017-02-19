<?php
namespace Buonzz\Elastictl\ElasticSearch;

use Buonzz\Elastictl\ElasticSearch\ClientFactory;

class IndexDecorator{

	private $output;
	
	public function __construct($indexname){

		$output = [];

		$client = ClientFactory::getClient(); 
		$stats = $client->indices()->stats(['index' => $indexname]);
		$health = $client->cluster()->health(['index' => $indexname, 'level' => 'shards']);

		$output['name'] = $indexname;
		$output['documents'] = $stats['indices'][$indexname]['total']['docs']['count']; 
		$output['size'] = $stats['indices'][$indexname]['total']['store']['size_in_bytes'];
		$output['health'] = $health['indices'][$indexname]['status'];

		$this->output = $output;		
	}

	public function get(){
		return $this->output;
	}
}