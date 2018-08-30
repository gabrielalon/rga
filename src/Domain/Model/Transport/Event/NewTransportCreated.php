<?php

namespace RGA\Domain\Model\Transport\Event;

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
	 * @return Transport\Activation
	 */
	public function transportActivation(): Transport\Activation
	{
		return Transport\Activation::fromBoolean((bool)($this->payload['activation'] ?? false));
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
		return Transport\Domains::fromArray((array)(\json_decode($this->payload['domains'], true) ?? []));
	}
	
	/**
	 * @return Transport\Names
	 */
	public function transportNames(): Transport\Names
	{
		return Transport\Names::fromArray((array)(\json_decode($this->payload['names'], true) ?? []));
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