<?php

namespace RGA\Application\SegregationSourcing\Query\V1;

interface StorageEventQueryInterface
{
	/**
	 * @param FindAllByEventId $query
	 */
	public function findAllByEventId(FindAllByEventId $query): void;
}