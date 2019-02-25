<?php

namespace RGA\Application\Transport\Event;

use RGA\Domain\Model\Transport\Transport;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewTransportCreated
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Transport\Uuid
	 */
	public function transportUuid(): Transport\Uuid
	{
		return Transport\Uuid::fromString($this->aggregateId());
	}
	
	/**
	 * @return Transport\Active
	 */
	public function transportActivation(): Transport\Active
	{
		return Transport\Active::fromBoolean((bool)($this->payload['activation'] ?? false));
	}
	
	/**
	 * @return Transport\ShipmentId
	 */
	public function transportShipmentId(): Transport\ShipmentId
	{
		return Transport\ShipmentId::fromInteger((integer)($this->payload['shipment_id'] ?? 0));
	}
	
	/**
	 * @return Transport\Domains
	 */
	public function transportDomains(): Transport\Domains
	{
		return Transport\Domains::fromArray((array)($this->payload['domains'] ? \unserialize($this->payload['domains'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @return Transport\Names
	 */
	public function transportNames(): Transport\Names
	{
		return Transport\Names::fromArray((array)($this->payload['names'] ? \unserialize($this->payload['names'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Transport $transport
	 */
	public function populate(Aggregate\AggregateRoot $transport): void
	{
		$transport->setUuid($this->transportUuid());
		$transport->setActivation($this->transportActivation());
		$transport->setShipmentId($this->transportShipmentId());
		$transport->setNames($this->transportNames());
		$transport->setDomains($this->transportDomains());
	}
}