<?php
namespace Buonzz\Elastictl\ElasticSearch;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Buonzz\Elastictl\ElasticSearch\IndexDecorator;

class IndexRepository{

	private $listing;

	public function __construct(){
		$this->listing = new IndexListing();
	}

	public function all(){
		$output = [];
		
		$col = $this->listing->get();

		$processed = $col->map(function($item){
			$obj = new IndexDecorator($item);
			return $obj->get();
		});
		
		return $processed;
	}
}