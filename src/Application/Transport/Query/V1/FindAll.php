<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Query\QueryMessage;

class FindAll
	extends QueryMessage
{
	public function __construct()
	{
		$this->init();
	}
}