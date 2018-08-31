<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\Persist;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot\Snapshot;

interface SnapshotRepositoryInterface
{
	/**
	 * @param Snapshot $snapshot
	 */
	public function save(Snapshot $snapshot): void;
	
	/**
	 * @param AggregateType $aggregateType
	 * @param string $aggregateId
	 * @return array
	 */
	public function get(AggregateType $aggregateType, string $aggregateId): array;
}