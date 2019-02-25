<?php

namespace RGA\Application\SegregationSourcing\Query\ReadModel;

use RGA\Domain\Model\SegregationSourcing\StorageEvent AS VO;
use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class StorageEvent
	implements Viewable
{
	/** @var VO\EventId */
	private $eventId;
	
	/** @var VO\EventName */
	private $eventName;
	
	/** @var VO\Payload */
	private $payload;
	
	/** @var VO\Metadata */
	private $metadata;
	
	/** @var VO\Version */
	private $version;
	
	/** @var VO\CreatedAt */
	private $createdAt;
	
	/** @var VO\Responsible */
	private $responsible;
	
	/**
	 * @param int $version
	 * @return StorageEvent
	 */
	public static function fromVersion(int $version): StorageEvent
	{
		return new static($version);
	}
	
	/**
	 * @param int $version
	 */
	public function __construct(int $version)
	{
		$this->setVersion(VO\Version::fromInteger($version));
	}
	
	/**
	 * @return string|integer
	 */
	public function identifier()
	{
		return $this->version();
	}
	
	/**
	 * @return string
	 */
	public function eventId(): string
	{
		return $this->eventId->toString();
	}
	
	/**
	 * @return VO\EventId
	 */
	public function getEventId(): VO\EventId
	{
		return $this->eventId;
	}
	
	/**
	 * @param VO\EventId $eventId
	 * @return StorageEvent
	 */
	public function setEventId(VO\EventId $eventId): StorageEvent
	{
		$this->eventId = $eventId;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function eventName(): string
	{
		return $this->eventName->toString();
	}
	
	/**
	 * @return VO\EventName
	 */
	public function getEventName(): VO\EventName
	{
		return $this->eventName;
	}
	
	/**
	 * @param VO\EventName $eventName
	 * @return StorageEvent
	 */
	public function setEventName(VO\EventName $eventName): StorageEvent
	{
		$this->eventName = $eventName;
		
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function payload(): array
	{
		return $this->payload->raw();
	}
	
	/**
	 * @return VO\Payload
	 */
	public function getPayload(): VO\Payload
	{
		return $this->payload;
	}
	
	/**
	 * @param VO\Payload $payload
	 * @return StorageEvent
	 */
	public function setPayload(VO\Payload $payload): StorageEvent
	{
		$this->payload = $payload;
		
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function metadata(): array
	{
		return $this->metadata->raw();
	}
	
	/**
	 * @return VO\Metadata
	 */
	public function getMetadata(): VO\Metadata
	{
		return $this->metadata;
	}
	
	/**
	 * @param VO\Metadata $metadata
	 * @return StorageEvent
	 */
	public function setMetadata(VO\Metadata $metadata): StorageEvent
	{
		$this->metadata = $metadata;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function version(): string
	{
		return $this->version->toString();
	}
	
	/**
	 * @return VO\Version
	 */
	public function getVersion(): VO\Version
	{
		return $this->version;
	}
	
	/**
	 * @param VO\Version $version
	 * @return StorageEvent
	 */
	public function setVersion(VO\Version $version): StorageEvent
	{
		$this->version = $version;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function createdAt(): string
	{
		return $this->createdAt->toString();
	}
	
	/**
	 * @return VO\CreatedAt
	 */
	public function getCreatedAt(): VO\CreatedAt
	{
		return $this->createdAt;
	}
	
	/**
	 * @param VO\CreatedAt $createdAt
	 * @return StorageEvent
	 */
	public function setCreatedAt(VO\CreatedAt $createdAt): StorageEvent
	{
		$this->createdAt = $createdAt;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function responsible(): string
	{
		return $this->responsible->toString();
	}
	
	/**
	 * @return VO\Responsible
	 */
	public function getResponsible(): VO\Responsible
	{
		return $this->responsible;
	}
	
	/**
	 * @param VO\Responsible $responsible
	 * @return StorageEvent
	 */
	public function setResponsible(VO\Responsible $responsible): StorageEvent
	{
		$this->responsible = $responsible;
		
		return $this;
	}
}