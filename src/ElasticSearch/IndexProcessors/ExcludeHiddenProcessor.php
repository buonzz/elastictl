<?php
namespace Buonzz\Elastictl\ElasticSearch\IndexProcessors;

use Buonzz\Elastictl\ElasticSearch\IndexDecorator;


class ExcludeHiddenProcessor{

	public function process($collection){
		
		$processed = $collection->reject(function($item){
			return $item['name'][0] == '.';
		});
		return $processed;
	}
}
