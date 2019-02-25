<?php

namespace RGA\Infrastructure\Query\Dictionary;

use RGA\Application\Dictionary\Query;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryDictionaryQuery
	implements Query\V1\DictionaryQueryInterface
{
	/** @var Query\ReadModel\DictionaryCollection */
	private $entities;
	
	/**
	 * @param Query\ReadModel\Dictionary $readModel
	 */
	public function store(Query\ReadModel\Dictionary $readModel): void
	{
		if (null === $this->entities)
		{
			$this->entities = new Query\ReadModel\DictionaryCollection();
		}
		
		$this->entities->add($readModel);
	}
	
	/**
	 * @param Query\V1\FindOneByUuid $query
	 */
	public function findOneByUuid(Query\V1\FindOneByUuid $query): void
	{
		$filter = new Filter\ByUuidFilter($this->entities);
		$filter->setUuid($query->getUuid());
		$filter->rewind();
		
		/** @var Query\ReadModel\Dictionary $readModel */
		if ($readModel = $filter->current())
		{
			$query->setView($readModel);
			return;
		}
		
		throw new Exception\ResourceNotFoundException(
			'Dictionary not found by uuid: ' . $query->getUuid(),
			404
		);
	}
	
	/**
	 * @param Query\V1\FindAllByType $query
	 */
	public function findAllByType(Query\V1\FindAllByType $query): void
	{
		$collection = new Query\ReadModel\DictionaryCollection();
		
		$filter = new Filter\ByTypeFilter($this->entities);
		$filter->setType($query->getType());
		$filter->rewind();
		
		while ($filter->valid())
		{
			/** @var Query\ReadModel\Dictionary $readModel */
			$readModel = $filter->current();
			
			$collection->add($readModel);
			$filter->next();
		}
		
		$query->setViewCollection($collection);
	}
	
	/**
	 * @param Query\V1\FindAll $query
	 */
	public function findAll(Query\V1\FindAll $query): void
	{
		$query->setViewCollection(new Query\ReadModel\DictionaryCollection($this->entities->all()));
	}
	
	/**
	 * @param Query\V1\FindAllByTypeAndBehaviourUuid $query
	 */
	public function findAllByTypeAndBehaviourUuid(Query\V1\FindAllByTypeAndBehaviourUuid $query): void
	{
		$collection = new Query\ReadModel\DictionaryCollection();
		
		$filter = new Filter\ByTypeAndBehaviourUuidFilter($this->entities);
		$filter->setType($query->getType());
		$filter->setUuid($query->getUuid());
		$filter->rewind();
		
		while ($filter->valid())
		{
			/** @var Query\ReadModel\Dictionary $readModel */
			$readModel = $filter->current();
			
			$collection->add($readModel);
			$filter->next();
		}
		
		$query->setViewCollection($collection);
	}
}