<?php

namespace RGA\Application\Additional\Event;

use RGA\Domain\Model\Additional\Additional;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewAdditionalCreated
	extends Aggregate\EventBridge\AggregateChanged
{	
	/**
	 * @return Additional\RgaUuid
	 */
	public function additionalRgaUuid(): Additional\RgaUuid
	{
		return Additional\RgaUuid::fromString($this->aggregateId());
	}
	
	/**
	 * @return Additional\ServiceType
	 */
	public function additionalServiceType(): Additional\ServiceType
	{
		return Additional\ServiceType::fromString((string)($this->payload['service_type'] ?? ''));
	}
	
	/**
	 * @return Additional\ServiceData
	 */
	public function additionalServiceData(): Additional\ServiceData
	{
		return Additional\ServiceData::fromArray((array)($this->payload['service_data'] ?? ''));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Additional $additional
	 */
	public function populate(Aggregate\AggregateRoot $additional): void
	{
		$additional->setRgaUuid($this->additionalRgaUuid());
		$additional->setServiceType($this->additionalServiceType());
		$additional->setServiceData($this->additionalServiceData());
	}
}