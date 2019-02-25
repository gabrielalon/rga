<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventStore\Stream;

class EventStream
{
	/** @var string */
	private $aggregateId;
	
	/** @var integer */
	private $aggregateVersion;
	
	/** @var string */
	private $eventName;
	
	/** @var array */
	private $payload;
	
	/** @var array */
	private $metadata;
	
	/**
	 * @param string $aggregateId
	 * @param int $aggregateVersion
	 * @param string $eventName
	 * @param array $payload
	 * @param array $metadata
	 */
	public function __construct(
		string $aggregateId,
		int $aggregateVersion,
		string $eventName,
		array $payload,
		array $metadata
	) {
		$this->aggregateId = $aggregateId;
		$this->aggregateVersion = $aggregateVersion;
		$this->eventName = $eventName;
		$this->payload = $payload;
		$this->metadata = $metadata;
	}
	
	/**
	 * @return string
	 */
	public function getAggregateId()
	{
		return $this->aggregateId;
	}
	
	/**
	 * @return int
	 */
	public function getAggregateVersion()
	{
		return $this->aggregateVersion;
	}
	
	/**
	 * @return string
	 */
	public function getEventName()
	{
		return $this->eventName;
	}
	
	/**
	 * @return array
	 */
	public function getPayload()
	{
		return $this->payload;
	}
	
	/**
	 * @return array
	 */
	public function getMetadata()
	{
		return $this->metadata;
	}
}