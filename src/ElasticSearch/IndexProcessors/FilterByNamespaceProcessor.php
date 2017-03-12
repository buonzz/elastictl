<?php
namespace Buonzz\Elastictl\ElasticSearch\IndexProcessors;

use Buonzz\Elastictl\ElasticSearch\IndexDecorator;


class FilterByNamespaceProcessor{

	public function process($collection, $namespace){
		
		$processed = $collection->reject(function($item) use ($namespace){

			$namespace = str_replace('*' , '', $namespace);
			$length = strlen($namespace);

			$to_match = substr($item['name'],0,$length);

			if($to_match != $namespace)
				return $item['name'][0] == '.';
		});

		return $processed;

	}
}
