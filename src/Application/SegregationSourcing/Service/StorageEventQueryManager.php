<?php

namespace RGA\Application\SegregationSourcing\Service;

use RGA\Application\SegregationSourcing\Query;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractQueryManager;

class StorageEventQueryManager
	extends AbstractQueryManager
{
	/**
	 * @param string $uuid
	 * @return Query\ReadModel\StorageEventCollection
	 */
	public function findAllByEventId(string $uuid): Query\ReadModel\StorageEventCollection
	{
		$query = new Query\V1\FindAllByEventId($uuid);
		
		$this->handle($query);
		
		/** @var Query\ReadModel\StorageEventCollection $collection */
		$collection = $query->getViewCollection();
		
		return $collection;
	}
}