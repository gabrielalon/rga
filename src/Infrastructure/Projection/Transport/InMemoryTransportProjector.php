<?php

namespace RGA\Infrastructure\Projection\Transport;

use RGA\Application\Transport\Event;
use RGA\Application\Transport\Query\ReadModel;
use RGA\Domain\Model\Transport\Projection\TransportProjectorInterface;

class InMemoryTransportProjector
	implements TransportProjectorInterface
{
	/** @var ReadModel\Transport[] */
	private $transports = [];
	
	/**
	 * @param Event\NewTransportCreated $event
	 */
	public function onNewTransportCreated(Event\NewTransportCreated $event): void
	{
		$this->transports[$event->transportUuid()->toString()] = ReadModel\Transport::fromUuid($event->transportUuid())
			->setActive($event->transportActivation())
			->setShipmentId($event->transportShipmentId())
			->setDomains($event->transportDomains())
			->setNames($event->transportNames());
	}
	
	/**
	 * @param Event\ExistingTransportChanged $event
	 */
	public function onExistingTransportChanged(Event\ExistingTransportChanged $event): void
	{
		$entity = $this->get($event->aggregateId())
			->setActive($event->transportActivation())
			->setShipmentId($event->transportShipmentId())
			->setDomains($event->transportDomains())
			->setNames($event->transportNames());
		
		$this->transports[$event->aggregateId()] = $entity;
	}
	
	/**
	 * @param Event\ExistingTransportRemoved $event
	 */
	public function onExistingTransportRemoved(Event\ExistingTransportRemoved $event): void
	{
		unset($this->transports[$event->aggregateId()]);
	}
	
	
	/**
	 * @param string $uuid
	 * @return ReadModel\Transport
	 */
	public function get(string $uuid): ReadModel\Transport
	{
		if (false === isset($this->transports[$uuid]))
		{
			throw new \RuntimeException('Transport entity not found for uuid: ' . $uuid);
		}
		
		return $this->transports[$uuid];
	}
}