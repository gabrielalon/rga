<?php

namespace RGA\Application\Transport\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class TransportQueryHandler
	implements QueryHandlerInterface
{
	/** @var TransportQueryInterface */
	protected $repository;
	
	/**
	 * @param TransportQueryInterface $repository
	 */
	public function __construct(TransportQueryInterface $repository)
	{
		$this->repository = $repository;
	}
}