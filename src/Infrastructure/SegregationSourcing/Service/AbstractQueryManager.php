<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

use RGA\Infrastructure\SegregationSourcing\Query;

abstract class AbstractQueryManager
{
	/** @var Query\Querying\QueryBus */
	private $queryBus;
	
	/** @var boolean */
	private $useSilentException;
	
	/**
	 * @param Query\Querying\QueryBus $queryBus
	 */
	public function __construct(Query\Querying\QueryBus $queryBus)
	{
		$this->queryBus = $queryBus;
		$this->useSilentException(true);
	}
	
	/**
	 * @param bool $useSilentException
	 */
	public function useSilentException(bool $useSilentException): void
	{
		$this->useSilentException = $useSilentException;
	}
	
	/**
	 * @param Query\Query\QueryInterface $query
	 */
	public function handle(Query\Query\QueryInterface $query): void
	{
		$this->queryBus->dispatch($query);
	}
}