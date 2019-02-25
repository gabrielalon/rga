<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

class QueryManagerRegistry
{
	/** @var AbstractQueryManager[] */
	private $registry = [];
	
	/**
	 * @param AbstractQueryManager $queryManager
	 */
	public function register(AbstractQueryManager $queryManager): void
	{
		$this->registry[\get_class($queryManager)] = $queryManager;
	}
	
	/**
	 * @param string $class
	 * @return AbstractQueryManager
	 */
	public function get(string $class): AbstractQueryManager
	{
		return $this->registry[$class];
	}
}