<?php

namespace RGA\Test\Infrastructure\SegregationSourcing\Snapshot;

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
		$this->snapshots[$snapshot->getAggregateId()] = $snapshot;
	}
	
	/**
	 * @param string $aggregateId
	 * @return array
	 */
	public function get(string $aggregateId): array
	{
		if (false === isset($this->snapshots[$aggregateId]))
		{
			throw new \RuntimeException('Snapshot not found for aggregate: ' . $aggregateId);
		}
		
		return [
			'aggregate_root' => $this->snapshots[$aggregateId]->getAggregateRoot(),
			'aggregate_version' => $this->snapshots[$aggregateId]->getLastVersion(),
			'created_at' => $this->snapshots[$aggregateId]->getCreatedAt()
		];
	}
}