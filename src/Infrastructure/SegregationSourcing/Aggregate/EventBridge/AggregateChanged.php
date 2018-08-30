<?php

namespace RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge;

use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;
use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\Stream\EventStream;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\DomainMessage;

abstract class AggregateChanged
	extends DomainMessage
		implements EventInterface
{
	/** @var array */
	protected $payload = [];
	
	/**
	 * @param string $aggregateId
	 * @param array $payload
	 * @return AggregateChanged
	 */
	public static function occur(string $aggregateId, array $payload = []): self
	{
		return new static($aggregateId, $payload);
	}
	
	/**
	 * @param EventStream $stream
	 * @return static
	 */
	public static function fromEventStream(EventStream $stream): self
	{
		return new static($stream->getAggregateId(), $stream->getPayload(), $stream->getMetadata());
	}
	
	/**
	 * @param string $aggregateId
	 * @param array $payload
	 * @param array $metadata
	 */
	protected function __construct(string $aggregateId, array $payload, array $metadata = [])
	{
		$this->metadata = $metadata;
		$this->setAggregateId($aggregateId);
		$this->setVersion($metadata['_aggregate_version'] ?? 1);
		$this->setPayload($payload);
		$this->init();
	}
	
	/**
	 * @return string
	 */
	public function aggregateId(): string
	{
		return $this->metadata['_aggregate_id'];
	}
	
	/**
	 * @return array
	 */
	public function payload(): array
	{
		return $this->payload;
	}
	
	/**
	 * @return int
	 */
	public function version(): int
	{
		return $this->metadata['_aggregate_version'];
	}
	
	/**
	 * @param int $version
	 * @return AggregateChanged
	 */
	public function withVersion(int $version): AggregateChanged
	{
		$self = clone $this;
		$self->setVersion($version);
		
		return $self;
	}
	
	/**
	 * @param string $aggregateId
	 */
	protected function setAggregateId(string $aggregateId): void
	{
		$this->metadata['_aggregate_id'] = $aggregateId;
	}
	
	/**
	 * @param int $version
	 */
	protected function setVersion(int $version): void
	{
		$this->metadata['_aggregate_version'] = $version;
	}
	
	/**
	 * @param array $payload
	 */
	protected function setPayload(array $payload): void
	{
		$this->payload = $payload;
	}
	
	/**
	 * @param AggregateRoot $aggregateRoot
	 */
	abstract public function populate(AggregateRoot $aggregateRoot): void;
}