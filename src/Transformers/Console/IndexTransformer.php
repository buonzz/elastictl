<?php
namespace Buonzz\Elastictl\Transformers\Console;

use League\Fractal;

class IndexTransformer extends Fractal\TransformerAbstract
{
	public function transform($index)
	{
	    return [
	        'name'  => $index['name'],
	        'documents'   => $index['documents_friendly'],
	        'size'    => $index['size_friendly'],
            'health'   => $index['health']
	    ];
	}
}