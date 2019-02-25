<?php

namespace RGA\Application\Transport\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Transport\Query;
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
		$transportRepository = $container->get(Query\V1\TransportQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAll::class)
			->to(new Query\V1\FindAllHandler($transportRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindAllActiveForDomain::class)
			->to(new Query\V1\FindAllActiveForDomainHandler($transportRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindAllActive::class)
			->to(new Query\V1\FindAllActiveHandler($transportRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByUuid::class)
			->to(new Query\V1\FindOneByUuidHandler($transportRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}