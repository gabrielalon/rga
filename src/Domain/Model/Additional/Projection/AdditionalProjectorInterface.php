<?php

namespace RGA\Domain\Model\Additional\Projection;

use RGA\Application\Additional\Event;

interface AdditionalProjectorInterface
{
	/**
	 * @param Event\NewAdditionalCreated $event
	 */
	public function onNewAdditionalCreated(Event\NewAdditionalCreated $event): void;
}