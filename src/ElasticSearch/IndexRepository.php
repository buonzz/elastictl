<?php
namespace Buonzz\Elastictl\ElasticSearch;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class IndexRepository{
	private $client;	
	public function __construct(){
		$this->client = new Client([
		    'base_uri' => getenv("ES_PROTOCOL") . '://'. getenv("ES_HOST") . ":". getenv("ES_PORT"),
		    'timeout'  => getenv("ES_TIMEOUT"),
		]);
	} // constructor

	public function all(){
		$output = [];
		$response = $this->client->request('GET', '*/_aliases');
		if( $response->getStatusCode() == 200){
			$body = $response->getBody();
			$stringBody = (string) $body;
			$data = json_decode($stringBody);
			$output = array_keys(get_object_vars($data));
		}
		return new Collection($output);
	}
}