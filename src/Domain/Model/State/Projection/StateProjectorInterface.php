<?php

namespace RGA\Domain\Model\State\Projection;

use RGA\Domain\Model\State\Event;

interface StateProjectorInterface
{
	/**
	 * @param Event\NewStateCreated $event
	 */
	public function onNewStateCreated(Event\NewStateCreated $event): void;
	
	/**
	 * @param Event\ExistingStateChanged $event
	 */
	public function onExistingStateChanged(Event\ExistingStateChanged $event): void;
	
	/**
	 * @param Event\ExistingStateRemoved $event
	 */
	public function onExistingStateRemoved(Event\ExistingStateRemoved $event): void;
}