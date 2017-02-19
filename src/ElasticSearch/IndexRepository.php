<?php
namespace Buonzz\Elastictl\ElasticSearch;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class IndexRepository{

	private $listing;

	public function __construct(){
		$this->listing = new IndexListing();
	}

	public function all(){
		$output = [];
		
		$col = $this->listing->get();

		$processed = $col->map(function($item){
			return [
					"name" => $item ,
			 		"documents" => 0,
			 		"size" => 0,
			 		"status" => "open",
			 		"health" => "green"
			 	];
		});
		
		return $processed;
	}
}