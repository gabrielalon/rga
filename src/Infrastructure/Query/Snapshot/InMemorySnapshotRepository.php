<?php

namespace RGA\Infrastructure\Query\Snapshot;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Persist\SnapshotRepositoryInterface;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot;
use RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore\SerializerInterface;

class InMemorySnapshotRepository
	implements SnapshotRepositoryInterface
{
	/** @var Snapshot\Snapshot[] */
	private $snapshots = [];
	
	public function setSerializer(SerializerInterface $serializer): void
	{
		// TODO: Implement setSerializer() method.
	}
	
	/**
	 * @param Snapshot\Snapshot $snapshot
	 */
	public function save(Snapshot\Snapshot $snapshot): void
	{
		$this->snapshots[$snapshot->getAggregateType()->getAggregateType()][$snapshot->getAggregateId()] = $snapshot;
	}
	
	/**
	 * @param AggregateType $aggregateType
	 * @param string|integer $aggregateId
	 * @return Snapshot\SnapshotDto
	 */
	public function get(AggregateType $aggregateType, $aggregateId): Snapshot\SnapshotDto
	{
		if (false === isset($this->snapshots[$aggregateType->getAggregateType()][$aggregateId]))
		{
			throw new \RuntimeException('Snapshot not found for aggregate: ' . $aggregateId);
		}
		
		/** @var Snapshot\Snapshot $snapshot */
		$snapshot = $this->snapshots[$aggregateType->getAggregateType()][$aggregateId];
		
		return Snapshot\SnapshotDto::fromVersion($snapshot->getLastVersion())
			->setCreated($snapshot->getCreatedAt())
			->setRoot($snapshot->getAggregateRoot())
		;
	}
}