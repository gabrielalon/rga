<?php

namespace RGA\Application\State\Event;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingStateRemoved
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @param Aggregate\AggregateRoot|State $state
	 */
	public function populate(Aggregate\AggregateRoot $state): void
	{
		// no need to do anything
	}
}