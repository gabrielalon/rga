<?php

namespace RGA\Application\Behaviour\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Behaviour\Query;
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
		$behaviourRepository = $container->get(Query\V1\BehaviourQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAll::class)
			->to(new Query\V1\FindAllHandler($behaviourRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindAllActive::class)
			->to(new Query\V1\FindAllActiveHandler($behaviourRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByType::class)
			->to(new Query\V1\FindOneByTypeHandler($behaviourRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByUuid::class)
			->to(new Query\V1\FindOneByUuidHandler($behaviourRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}