<?php

namespace RGA\Application\State\Query\V1;

use RGA\Infrastructure\SegregationSourcing\Query\Querying\QueryHandlerInterface;

abstract class StateQueryHandler
	implements QueryHandlerInterface
{
	/** @var StateQueryInterface */
	protected $repository;
	
	/**
	 * @param StateQueryInterface $repository
	 */
	public function __construct(StateQueryInterface $repository)
	{
		$this->repository = $repository;
	}
}