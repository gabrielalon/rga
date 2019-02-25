<?php

namespace RGA\Application\State\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\State\Query;
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
		$stateRepository = $container->get(Query\V1\StateQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAll::class)
			->to(new Query\V1\FindAllHandler($stateRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByName::class)
			->to(new Query\V1\FindOneByNameHandler($stateRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByRgaUuid::class)
			->to(new Query\V1\FindOneByRgaUuidHandler($stateRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByUuid::class)
			->to(new Query\V1\FindOneByUuidHandler($stateRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}