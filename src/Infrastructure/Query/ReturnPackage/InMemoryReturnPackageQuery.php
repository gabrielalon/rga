<?php

namespace RGA\Infrastructure\Query\ReturnPackage;

use RGA\Application\ReturnPackage\Query;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryReturnPackageQuery
	implements Query\V1\ReturnPackageQueryInterface
{
	/** @var Query\ReadModel\ReturnPackageCollection*/
	private $entities;
	
	/**
	 * @param Query\ReadModel\ReturnPackage $view
	 */
	public function store(Query\ReadModel\ReturnPackage $view): void
	{
		if (null === $this->entities)
		{
			$this->entities = new Query\ReadModel\ReturnPackageCollection();
		}
		
		$this->entities->add($view);
	}
	
	/**
	 * @param Query\V1\FindOneById $query
	 */
	public function findOneById(Query\V1\FindOneById $query): void
	{
		$filter = new Filter\ByUuidFilter($this->entities);
		$filter->setUuid($query->getId());
		$filter->rewind();
		
		/** @var Query\ReadModel\ReturnPackage $view */
		if ($view = $filter->current())
		{
			$query->setView($view);
			return;
		}
		
		throw new Exception\ResourceNotFoundException(
			'ReturnPackage not found by id: ' . $query->getId(),
			404
		);
	}
	
	/**
	 * @param Query\V1\FindAllByRgaUuid $query
	 */
	public function findAllByRgaUuid(Query\V1\FindAllByRgaUuid $query): void
	{
		$collection = new Query\ReadModel\ReturnPackageCollection();
		
		$filter = new Filter\ByRgaUuidFilter($this->entities);
		$filter->setUuid($query->getUuid());
		$filter->rewind();
		
		while ($filter->valid())
		{
			/** @var Query\ReadModel\ReturnPackage $view */
			$view = $filter->current();
			
			$collection->add($view);
			$filter->next();
		}
		
		$query->setViewCollection($collection);
	}
}