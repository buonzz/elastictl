<?php
namespace Buonzz\Elastictl\ElasticSearch;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

use Buonzz\Elastictl\ElasticSearch\IndexProcessors\AddMetadataProcessor;
use Buonzz\Elastictl\ElasticSearch\IndexProcessors\ExcludeHiddenProcessor;

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
		$metadata_processor = AddMetadataProcessor();	
		$processed = $metadata_processor->process($col);

		// dont return items that starts with "." as this is usually used by Kibana/Marvel
		if($params['exclude_hidden'] == 'yes')
		{

			// add additional attributes
			$excludehidden_processor = ExcludeHiddenProcessor();	
			$processed = $excludehidden_processor->process($col);

		}

		// sort by what field
		if(isset($params['sort_by']))
		{
			$processed = $processed->sortBy($params['sort_by']);
		}		

		return $processed;
	}
}