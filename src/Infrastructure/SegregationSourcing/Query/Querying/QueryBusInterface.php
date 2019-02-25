<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Querying;

use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;
use RGA\Infrastructure\SegregationSourcing\Query\Query;

interface QueryBusInterface
	extends MessageBusInterface
{
	/**
	 * @param Query\QueryInterface $query
	 */
	public function dispatch(Query\QueryInterface $query): void;
}