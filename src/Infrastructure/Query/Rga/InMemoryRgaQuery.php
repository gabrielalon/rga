<?php

namespace RGA\Infrastructure\Query\Rga;

use RGA\Application\Rga\Query;
use RGA\Infrastructure\Query\Filter;
use RGA\Infrastructure\SegregationSourcing\Query\Exception;

class InMemoryRgaQuery
	implements Query\V1\RgaQueryInterface
{
	/** @var Query\ReadModel\RgaCollection */
	private $entities;
	
	/**
	 * @param Query\ReadModel\Rga $view
	 */
	public function store(Query\ReadModel\Rga $view): void
	{
		if (null === $this->entities)
		{
			$this->entities = new Query\ReadModel\RgaCollection();
		}
		
		$this->entities->add($view);
	}
	
	/**
	 * @param Query\V1\FindOneByUuid $query
	 */
	public function findOneByUuid(Query\V1\FindOneByUuid $query): void
	{
		$filter = new Filter\ByUuidFilter($this->entities);
		$filter->setUuid($query->getUuid());
		$filter->rewind();
		
		/** @var Query\ReadModel\Rga $view */
		if ($view = $filter->current())
		{
			$query->setView($view);
			return;
		}
		
		throw new Exception\ResourceNotFoundException(
			'Rga not found by uuid: ' . $query->getUuid(),
			404
		);
	}
	
	/**
	 * @param Query\V1\FindOneByCode $query
	 */
	public function findOneByCode(Query\V1\FindOneByCode $query): void
	{
		$filter = new Filter\ByUuidFilter($this->entities);
		$filter->setUuid($query->getCode());
		$filter->rewind();
		
		/** @var Query\ReadModel\Rga $view */
		if ($view = $filter->current())
		{
			$query->setView($view);
			return;
		}
		
		throw new Exception\ResourceNotFoundException(
			'Rga not found by code: ' . $query->getCode(),
			404
		);
	}
	
	/**
	 * @param Query\V1\FindOneByHash $query
	 */
	public function findOneByHash(Query\V1\FindOneByHash $query): void
	{
		$filter = new Filter\ByHashFilter($this->entities);
		$filter->setHash($query->getHash());
		$filter->rewind();
		
		/** @var Query\ReadModel\Rga $view */
		if ($view = $filter->current())
		{
			$query->setView($view);
			return;
		}
		
		throw new Exception\ResourceNotFoundException(
			'Rga not found by hash: ' . $query->getHash(),
			404
		);
	}
	
	/**
	 * @param Query\V1\FindOneByIndividualNumber $query
	 */
	public function findOneByIndividualNumber(Query\V1\FindOneByIndividualNumber $query): void
	{
		$filter = new Filter\ByIndividualNumberFilter($this->entities);
		$filter->setIndividualNumber($query->getIndividualNumber());
		$filter->rewind();
		
		/** @var Query\ReadModel\Rga $view */
		if ($view = $filter->current())
		{
			$query->setView($view);
			return;
		}
		
		throw new Exception\ResourceNotFoundException(
			'Rga not found by individual number: ' . $query->getIndividualNumber(),
			404
		);
	}
	
	/**
	 * @param Query\V1\FindAll $query
	 */
	public function findAll(Query\V1\FindAll $query): void
	{
		$offset = max($query->getPage() - 1, 0) * $query->getLimit();
		
		$query->setViewCollection(new Query\ReadModel\RgaCollection(
			\array_slice($this->entities->all(), $offset, $query->getLimit())
		));
	}
}