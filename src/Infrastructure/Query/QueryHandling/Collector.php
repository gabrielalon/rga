<?php

namespace RGA\Infrastructure\Query\QueryHandling;

class Collector
	extends \ArrayIterator
{
	/**
	 * @param QueryHandlerInterface $handler
	 */
	public function add(QueryHandlerInterface $handler)
	{
		$this->append($handler);
	}
}