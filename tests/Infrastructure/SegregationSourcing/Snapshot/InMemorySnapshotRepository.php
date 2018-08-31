<?php

namespace RGA\Test\Infrastructure\SegregationSourcing\Snapshot;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot\Snapshot;

class InMemorySnapshotRepository
	implements SnapshotRepositoryInterface
{
	/** @var Snapshot[] */
	private $snapshots = [];
	
	/**
	 * @param Snapshot $snapshot
	 */
	public function save(Snapshot $snapshot): void
	{
		$this->snapshots[$snapshot->getAggregateType()->getAggregateType()][$snapshot->getAggregateId()] = $snapshot;
	}
	
	/**
	 * @param AggregateType $aggregateType
	 * @param string $aggregateId
	 * @return array
	 */
	public function get(AggregateType $aggregateType, string $aggregateId): array
	{
		if (false === isset($this->snapshots[$aggregateType->getAggregateType()][$aggregateId]))
		{
			throw new \RuntimeException('Snapshot not found for aggregate: ' . $aggregateId);
		}
		
		/** @var Snapshot $snapshot */
		$snapshot = $this->snapshots[$aggregateType->getAggregateType()][$aggregateId];
		
		return [
			'aggregate_root' => $snapshot->getAggregateRoot(),
			'aggregate_version' => $snapshot->getLastVersion(),
			'created_at' => $snapshot->getCreatedAt()
		];
	}
}