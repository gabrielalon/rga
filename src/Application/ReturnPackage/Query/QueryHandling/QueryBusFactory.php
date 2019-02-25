<?php

namespace RGA\Application\ReturnPackage\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\ReturnPackage\Query;
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
		$returnPackageRepository = $container->get(Query\V1\ReturnPackageQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAllByRgaUuid::class)
			->to(new Query\V1\FindAllByRgaUuidHandler($returnPackageRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneById::class)
			->to(new Query\V1\FindOneByIdHandler($returnPackageRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}