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

	public function all($params = ['exclude_hidden' => true]){

		$output = [];
		
		// get the plain listing of index names
		$col = $this->listing->get();

		// add additional attributes
		$processed = $col->map(function($item){
			$obj = new IndexDecorator($item);
			return $obj->get();
		});

		// dont return items that starts with "." as this is usually used by Kibana/Marvel
		if($params['exclude_hidden'] == 'yes')
		{
			$processed = $processed->reject(function($item){
				return $item['name'][0] == '.';
			});
		}

		// sort by what field
		if(isset($params['sort_by']))
		{
			$processed = $processed->sortBy($params['sort_by']);
		}		

		return $processed;
	}
}