<?php

namespace RGA\Application\State\Service;

use RGA\Application\State\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class StateQueryManager
	extends AbstractQueryManager
{
	/**
	 * @return Query\ReadModel\StateCollection
	 */
	public function findAll(): Query\ReadModel\StateCollection
	{
		$query = new Query\V1\FindAll();
		
		$this->handle($query);
		
		/** @var Query\ReadModel\StateCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
	
	/**
	 * @param array $name
	 * @return Query\ReadModel\State
	 */
	public function findOneByName(array $name = []): Query\ReadModel\State
	{
		$query = new Query\V1\FindOneByName($name);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\State $state */
		$state = $query->getView();
		
		return $state;
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\State
	 */
	public function findOneByRgaUuid(string $uuid): Query\ReadModel\State
	{
		$query = new Query\V1\FindOneByRgaUuid($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\State $state */
		$state = $query->getView();
		
		return $state;
	}
	
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\State
	 */
	public function findOneByUuid(string $uuid): Query\ReadModel\State
	{
		$query = new Query\V1\FindOneByUuid($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\State $state */
		$state = $query->getView();
		
		return $state;
	}
}