<?php

namespace RGA\Test\Infrastructure\Transport\Projection;

use RGA\Domain\Model\Transport\Event;
use RGA\Domain\Model\Transport\Projection\TransportProjectorInterface;
use RGA\Test\Mock\Entity\Transport\Transport;

class InMemoryTransportProjector
	implements TransportProjectorInterface
{
	/** @var  */
	private $transports = [];
	
	/**
	 * @param Event\NewTransportCreated $event
	 */
	public function onNewTransportCreated(Event\NewTransportCreated $event): void
	{
		$this->transports[$event->transportUuid()->toString()] = (new Transport())
			->setUuid($event->transportUuid())
			->setActivation($event->transportActivation())
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
			->setActivation($event->transportActivation())
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
	 * @return Transport
	 */
	public function get(string $uuid): Transport
	{
		if (false === isset($this->transports[$uuid]))
		{
			throw new \RuntimeException('Transport entity not found for uuid: ' . $uuid);
		}
		
		return $this->transports[$uuid];
	}
}