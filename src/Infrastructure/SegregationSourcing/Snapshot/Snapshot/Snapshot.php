<?php

namespace RGA\Infrastructure\SegregationSourcing\Snapshot\Snapshot;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateType;

class Snapshot
{
	/** @var AggregateType */
	private $aggregateType;
	
	/** @var string */
	private $aggregateId;
	
	/** @var AggregateRoot|string */
	private $aggregateRoot;
	
	/** @var integer */
	private $lastVersion;
	
	/** @var \DateTime */
	private $createdAt;
	
	/**
	 * @param AggregateType $aggregateType
	 * @param string $aggregateId
	 * @param AggregateRoot|string $aggregateRoot
	 * @param int $lastVersion
	 * @param \DateTime $createdAt
	 */
	public function __construct(
		AggregateType $aggregateType,
		string $aggregateId,
		$aggregateRoot,
		int $lastVersion,
		\DateTime $createdAt
	)
	{
		$this->aggregateType = $aggregateType;
		$this->aggregateId = $aggregateId;
		$this->aggregateRoot = $aggregateRoot;
		$this->lastVersion = $lastVersion;
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @return AggregateType
	 */
	public function getAggregateType(): AggregateType
	{
		return $this->aggregateType;
	}
	
	/**
	 * @return string
	 */
	public function getAggregateId(): string
	{
		return $this->aggregateId;
	}
	
	/**
	 * @return AggregateRoot|string
	 */
	public function getAggregateRoot()
	{
		return $this->aggregateRoot;
	}
	
	/**
	 * @return int
	 */
	public function getLastVersion(): int
	{
		return $this->lastVersion;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}
}