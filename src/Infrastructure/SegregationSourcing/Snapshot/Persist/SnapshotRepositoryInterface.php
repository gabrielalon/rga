<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\Persist;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;
use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot;
use RGA\Infrastructure\SegregationSourcing\Snapshot\SnapshotStore\SerializerInterface;

interface SnapshotRepositoryInterface
{
	/**
	 * @param SerializerInterface $serializer
	 */
	public function setSerializer(SerializerInterface $serializer): void;
	
	/**
	 * @param Snapshot\Snapshot $snapshot
	 */
	public function save(Snapshot\Snapshot $snapshot): void;
	
	/**
	 * @param AggregateType $aggregateType
	 * @param string|integer $aggregateId
	 * @return Snapshot\SnapshotDto
	 */
	public function get(AggregateType $aggregateType, $aggregateId): Snapshot\SnapshotDto;
}