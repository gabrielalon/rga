<?php

namespace RGA\Domain\Model\Rga\Event;

use RGA\Domain\Model\Rga\Rga as ValueObject;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Aggregate\AggregateRoot;

class StateRgaChanged
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return ValueObject\StateUuid
	 */
	public function rgaStateUuid(): ValueObject\StateUuid
	{
		return ValueObject\StateUuid::fromString((string)($this->payload['state_uuid'] ?? ''));
	}
	
	/**
	 * @param AggregateRoot|Rga $rga
	 */
	public function populate(AggregateRoot $rga): void
	{
		$rga->setStateUuid($this->rgaStateUuid());
	}
}