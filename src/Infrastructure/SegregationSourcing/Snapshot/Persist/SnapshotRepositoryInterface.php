<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\Persist;

use RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot\Snapshot;

interface SnapshotRepositoryInterface
{
	/**
	 * @param Snapshot $snapshot
	 */
	public function save(Snapshot $snapshot): void;
	
	/**
	 * @param string $aggregateId
	 * @return array
	 */
	public function get(string $aggregateId): array;
}