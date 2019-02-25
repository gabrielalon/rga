<?php

namespace RGA\Infrastructure\Projection\Additional;

use RGA\Application\Additional\Event;
use RGA\Application\Additional\Query\ReadModel;
use RGA\Domain\Model\Additional\Projection;

class InMemoryAdditionalProjector
	implements Projection\AdditionalProjectorInterface
{
	/** @var ReadModel\Additional[] */
	private $additionals = [];
	
	/**
	 * @param Event\NewAdditionalCreated $event
	 */
	public function onNewAdditionalCreated(Event\NewAdditionalCreated $event): void
	{
		$this->additionals[$event->additionalRgaUuid()->toString()] = ReadModel\Additional::fromId($event->aggregateId())
			->setRgaUuid($event->additionalRgaUuid())
			->setServiceType($event->additionalServiceType())
			->setServiceData($event->additionalServiceData());
	}
	
	/**
	 * @param string $uuid
	 * @return ReadModel\Additional
	 */
	public function get(string $uuid): ReadModel\Additional
	{
		if (false === isset($this->additionals[$uuid]))
		{
			throw new \RuntimeException('Additional entity not found for uuid: ' . $uuid);
		}
		
		return $this->additionals[$uuid];
	}
}