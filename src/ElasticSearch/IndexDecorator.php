<?php
namespace Buonzz\Elastictl\ElasticSearch;

use Buonzz\Elastictl\ElasticSearch\ClientFactory;

class IndexDecorator{

	private $output;
	public $format_result=true;
	
	public function __construct($indexname){

		$output = [];

		$client = ClientFactory::getClient(); 
		$stats = $client->indices()->stats(['index' => $indexname]);
		$health = $client->cluster()->health(['index' => $indexname, 'level' => 'shards']);

		$output['name'] = $indexname;
		$output['health'] = $health['indices'][$indexname]['status'];

		if($format_result)
		{
			$output['documents'] = $stats['indices'][$indexname]['total']['docs']['count']; 
			$output['size'] = $stats['indices'][$indexname]['total']['store']['size_in_bytes'];
		}
		else
		{
			$output['documents'] = $this->formatBytes($stats['indices'][$indexname]['total']['docs']['count']); 
			$output['size'] = strpad(number_format($stats['indices'][$indexname]['total']['store']['size_in_bytes']),11,STR_PAD_LEFT);			
		}

		$this->output = $output;		
	}

	public function get(){
		return $this->output;
	}


	function formatBytes($size, $precision = 2)
	{
	    $base = log($size, 1024);
	    $suffixes = array('', 'K', 'M', 'G', 'T');   

	    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
	}
}