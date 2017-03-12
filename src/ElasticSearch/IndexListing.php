<?php
namespace Buonzz\Elastictl\ElasticSearch;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

use Buonzz\Elastictl\Cache;

class IndexListing{

	private $client;
	private $cache;
	
	public function __construct(){

		$this->cache = new Cache;

		$this->client = new Client([
		    'base_uri' => getenv("ES_PROTOCOL") . '://'. getenv("ES_HOST") . ":". getenv("ES_PORT"),
		    'timeout'  => getenv("ES_TIMEOUT"),
		]);

	} // constructor

	public function get(){

		$output = [];

		$key = md5(getenv("ES_PROTOCOL") . '://'. getenv("ES_HOST") . ":". getenv("ES_PORT") . "Buonzz\Elastictl\IndexListing");

		$value = $this->cache->get($key);

		if($value == false)
		{

			$response = $this->client->request('GET', '*/_aliases');
			if( $response->getStatusCode() == 200){

				$body = $response->getBody();
				$stringBody = (string) $body;
				$data = json_decode($stringBody);
				$output = array_keys(get_object_vars($data));

				$this->cache->set($key, $output);
			}

		} // if 
		else{
			$output = $value;
		}

		$col = new Collection($output);
		return $col;

	}

} // class