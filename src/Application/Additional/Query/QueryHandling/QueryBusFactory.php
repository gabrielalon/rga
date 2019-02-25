<?php

namespace RGA\Application\Additional\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Additional\Query;
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
		$additionalRepository = $container->get(Query\V1\AdditionalQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAllByRgaUuid::class)
			->to(new Query\V1\FindAllByRgaUuidHandler($additionalRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}