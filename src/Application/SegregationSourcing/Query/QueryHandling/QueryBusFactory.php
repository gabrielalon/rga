<?php

namespace RGA\Application\SegregationSourcing\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\SegregationSourcing\Query;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\AbstractQueryBusFactory;
use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryBus;

class QueryBusFactory
	extends AbstractQueryBusFactory
{
	/**
	 * @param QueryBus $queryBus
	 * @param ContainerInterface $container
	 */
	public function populate(QueryBus $queryBus, ContainerInterface $container): void
	{
		$stateRepository = $container->get(Query\V1\StorageEventQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAllByEventId::class)
			->to(new Query\V1\FindAllByEventIdHandler($stateRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}