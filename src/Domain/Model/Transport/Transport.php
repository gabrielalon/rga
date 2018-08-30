<?php

namespace RGA\Domain\Model\Transport;

use RGA\Domain\Model\Transport\Transport as ValueObject;
use RGA\Domain\Model\Transport\Event;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Transport
	extends Aggregate\AggregateRoot
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Activation */
	private $activation;
	
	/** @var ValueObject\ShipmentId */
	private $shipmentId;
	
	/** @var ValueObject\Domains */
	private $domains;
	
	/** @var ValueObject\Names */
	private $names;
	
	/**
	 * @param Transport\Uuid $uuid
	 */
	public function setUuid(Transport\Uuid $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @param Transport\Activation $activation
	 */
	public function setActivation(Transport\Activation $activation): void
	{
		$this->activation = $activation;
	}
	
	/**
	 * @param Transport\ShipmentId $shipmentId
	 */
	public function setShipmentId(Transport\ShipmentId $shipmentId): void
	{
		$this->shipmentId = $shipmentId;
	}
	
	/**
	 * @param Transport\Domains $domains
	 */
	public function setDomains(Transport\Domains $domains): void
	{
		$this->domains = $domains;
	}
	
	/**
	 * @param Transport\Names $names
	 */
	public function setNames(Transport\Names $names): void
	{
		$this->names = $names;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * @param Transport\Uuid $uuid
	 * @param Transport\Activation $activation
	 * @param Transport\ShipmentId $shipmentId
	 * @param Transport\Domains $domains
	 * @param Transport\Names $names
	 * @return Transport
	 */
	public static function createNewTransport(
		ValueObject\Uuid $uuid,
		ValueObject\Activation $activation,
		ValueObject\ShipmentId $shipmentId,
		ValueObject\Domains $domains,
		ValueObject\Names $names
	): Transport
	{
		$transport = new Transport();
		
		$transport->recordThat(Event\NewTransportCreated::occur($uuid->toString(), [
			'activation'  => $activation->toString(),
			'shipment_id' => $shipmentId->toString(),
			'domains'     => $domains->toString(),
			'names'       => $names->toString()
		]));
		
		return $transport;
	}
	
	/**
	 * @param Transport\Activation $activation
	 * @param Transport\ShipmentId $shipmentId
	 * @param Transport\Domains $domains
	 * @param Transport\Names $names
	 */
	public function changeExistingTransport(
		ValueObject\Activation $activation,
		ValueObject\ShipmentId $shipmentId,
		ValueObject\Domains $domains,
		ValueObject\Names $names
	): void
	{
		$this->recordThat(Event\ExistingTransportChanged::occur($this->aggregateId(), [
			'activation'  => $activation->toString(),
			'shipment_id' => $shipmentId->toString(),
			'domains'     => $domains->toString(),
			'names'       => $names->toString()
		]));
	}
	
	public function removeExistingTransport(): void
	{
		$this->recordThat(Event\ExistingTransportRemoved::occur($this->aggregateId(), []));
	}
}