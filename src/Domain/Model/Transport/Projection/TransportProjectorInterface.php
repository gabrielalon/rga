<?php

namespace RGA\Domain\Model\Transport\Projection;

use RGA\Domain\Model\Transport\Event;

interface TransportProjectorInterface
{
	/**
	 * @param Event\NewTransportCreated $event
	 */
	public function onNewTransportCreated(Event\NewTransportCreated $event): void;
	
	/**
	 * @param Event\ExistingTransportChanged $event
	 */
	public function onExistingTransportChanged(Event\ExistingTransportChanged $event): void;
	
	/**
	 * @param Event\ExistingTransportRemoved $event
	 */
	public function onExistingTransportRemoved(Event\ExistingTransportRemoved $event): void;
}