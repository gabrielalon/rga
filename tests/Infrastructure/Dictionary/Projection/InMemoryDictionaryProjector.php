<?php

namespace RGA\Test\Infrastructure\Dictionary\Projection;

use RGA\Domain\Model\Dictionary\Event;
use RGA\Domain\Model\Dictionary\Projection\DictionaryProjectorInterface;
use RGA\Test\Mock\Entity\Dictionary\Dictionary;

class InMemoryDictionaryProjector
	implements DictionaryProjectorInterface
{
	/** @var Dictionary[] */
	private $entities = [];
	
	/**
	 * @param Event\NewDictionaryCreated $event
	 */
	public function onNewDictionaryCreated(Event\NewDictionaryCreated $event): void
	{
		$this->entities[$event->dictionaryUuid()->toString()] = (new Dictionary())
			->setUuid($event->dictionaryUuid())
			->setType($event->dictionaryType())
			->setValues($event->dictionaryValues());
	}
	
	/**
	 * @param Event\ExistingDictionaryChanged $event
	 */
	public function onExistingDictionaryChanged(Event\ExistingDictionaryChanged $event): void
	{
		$entity = $this->get($event->aggregateId());
		$entity->setValues($event->dictionaryValues());
		$this->entities[$event->aggregateId()] = $entity;
	}
	
	/**
	 * @param Event\ExistingDictionaryRemoved $event
	 */
	public function onExistingDictionaryRemoved(Event\ExistingDictionaryRemoved $event): void
	{
		unset($this->entities[$event->aggregateId()]);
	}
	
	/**
	 * @param string $uuid
	 * @return Dictionary
	 */
	public function get(string $uuid): Dictionary
	{
		if (false === isset($this->entities[$uuid]))
		{
			throw new \RuntimeException('Dictionary entity not found for uuid: ' . $uuid);
		}
		
		return $this->entities[$uuid];
	}
}