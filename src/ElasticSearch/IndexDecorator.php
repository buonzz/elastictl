<?php
namespace Buonzz\Elastictl\ElasticSearch;

use Buonzz\Elastictl\ElasticSearch\ClientFactory;
use Buonzz\Elastictl\Cache;

class IndexDecorator{

	private $output;
	public $format_result=true;
	private $cache;
	
	public function __construct($indexname){

		$output = [];
		$this->cache = new Cache;

		$key = md5(getenv("ES_PROTOCOL") . '://'. getenv("ES_HOST") . ":". getenv("ES_PORT") . "Buonzz\Elastictl\ElasticSearch\IndexDecorator" . $indexname);

		$value = $this->cache->get($key);


		if($value == false)
		{
			$client = ClientFactory::getClient(); 
			$stats = $client->indices()->stats(['index' => $indexname]);
			$health = $client->cluster()->health(['index' => $indexname, 'level' => 'shards']);

			$this->cache->set($key, ['stats' => $stats, 'health' => $health]);
		}
		else{
			$stats = $value['stats'];
			$health = $value['health'];
		}



		$output['name'] = $indexname;

		$output['documents'] = $stats['indices'][$indexname]['total']['docs']['count']; 
		$output['documents_friendly'] = number_format($stats['indices'][$indexname]['total']['docs']['count'],2); 

		$output['size'] = $stats['indices'][$indexname]['total']['store']['size_in_bytes'];
		$output['size_friendly'] = $this->formatBytes($stats['indices'][$indexname]['total']['store']['size_in_bytes']);

		$output['health'] = $health['indices'][$indexname]['status'];

		$this->output = $output;		
	}

	public function get(){
		return $this->output;
	}


	function formatBytes($size, $dec = 2)
	{
        $size   = array(' B', ' kB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];	}
}