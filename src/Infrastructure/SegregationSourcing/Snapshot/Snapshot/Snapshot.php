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
		$aggregateId,
		$aggregateRoot,
		$lastVersion,
		\DateTime $createdAt
	) {
		$this->aggregateType = $aggregateType;
		$this->aggregateId = $aggregateId;
		$this->aggregateRoot = $aggregateRoot;
		$this->lastVersion = $lastVersion;
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @return AggregateType
	 */
	public function getAggregateType()
	{
		return $this->aggregateType;
	}
	
	/**
	 * @return string
	 */
	public function getAggregateId()
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
	public function getLastVersion()
	{
		return $this->lastVersion;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
}