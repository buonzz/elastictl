<?php
namespace Buonzz\Elastictl\ElasticSearch\IndexProcessors;

use Buonzz\Elastictl\ElasticSearch\IndexDecorator;


class AddMetadataProcessor{

	public function process($collection){

		$processed = $collection->map(function($item){
			$obj = new IndexDecorator($item);
			return $obj->get();
		});

		return $processed;
	}
}
