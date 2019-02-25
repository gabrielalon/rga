<?php

namespace RGA\Infrastructure\SegregationSourcing\Message\Domain;

abstract class DomainMessage
	implements MessageInterface
{
	/** @var string */
	protected $messageName;
	
	/** @var string */
	protected $uuid;
	
	/** @var \DateTime */
	protected $recordedOn;
	
	/** @var array */
	protected $metadata = [];
	
	/**
	 * @param array $payload
	 */
	abstract protected function setPayload(array $payload);
	
	protected function init(): void
	{
		if ($this->uuid === null)
		{
			$this->uuid = (string)\Ramsey\Uuid\Uuid::uuid4();
		}
		
		if ($this->messageName === null)
		{
			$this->messageName = \get_class($this);
		}
		
		if ($this->recordedOn === null)
		{
			$this->recordedOn = new \DateTime('now');
		}
	}
	
	/**
	 * @return string
	 */
	public function messageName(): string
	{
		return $this->messageName;
	}
	
	/**
	 * @return array
	 */
	public function metadata(): array
	{
		return $this->metadata;
	}
	
	/**
	 * @return string
	 */
	public function metadataJSON(): string
	{
		return \json_encode($this->metadata());
	}
}
