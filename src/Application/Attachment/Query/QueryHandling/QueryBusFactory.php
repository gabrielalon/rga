<?php

namespace RGA\Application\Attachment\Query\QueryHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Attachment\Query;
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
		$attachmentRepository = $container->get(Query\V1\AttachmentQueryInterface::class);
		
		$this->queryRouter
			->route(Query\V1\FindAll::class)
			->to(new Query\V1\FindAllHandler($attachmentRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindAllByRgaUuid::class)
			->to(new Query\V1\FindAllByRgaUuidHandler($attachmentRepository))
		;
		
		$this->queryRouter
			->route(Query\V1\FindOneByUuid::class)
			->to(new Query\V1\FindOneByUuidHandler($attachmentRepository))
		;
		
		$this->attachRoutesToQueryBus($queryBus);
	}
}