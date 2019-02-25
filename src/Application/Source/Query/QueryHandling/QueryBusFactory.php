<?php

namespace RGA\Application\Source\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Source\Query;
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
		$stateRepository = $container->get(Query\RgaObjectQueryInterface::class);
		
		$this->queryRouter
			->route(Query\GetOne::class)
			->to(new Query\GetOneHandler($stateRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}