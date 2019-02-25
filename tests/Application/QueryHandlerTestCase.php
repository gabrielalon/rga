<?php

namespace RGA\Test\Application;

use RGA\Infrastructure\SegregationSourcing\Query;

abstract class QueryHandlerTestCase
	extends HandlerTestCase
{
	/**
	 * @return Query\Querying\QueryBus
	 */
	protected function getQueryBus(): Query\Querying\QueryBus
	{
		return $this->getFromContainer(Query\Querying\QueryBus::class);
	}
}