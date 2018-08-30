<?php

namespace RGA\Test\Infrastructure\Behaviour\Projection;

use RGA\Domain\Model\Behaviour\Event;
use RGA\Domain\Model\Behaviour\Projection\BehaviourProjectorInterface;
use RGA\Test\Mock\Entity\Behaviour\Behaviour;

class InMemoryBehaviourProjector
	implements BehaviourProjectorInterface
{
	/** @var Behaviour[] */
	private $entities = [];
	
	/**
	 * @param Event\NewBehaviourCreated $event
	 */
	public function onNewBehaviourCreated(Event\NewBehaviourCreated $event): void
	{
		$this->entities[$event->behaviourUuid()->toString()] = (new Behaviour())
			->setUuid($event->behaviourUuid())
			->setType($event->behaviourType())
			->setNames($event->behaviourNames())
			->setActivation($event->behaviourActivation());
	}
	
	/**
	 * @param Event\ExistingBehaviourChanged $event
	 */
	public function onExistingBehaviourChanged(Event\ExistingBehaviourChanged $event): void
	{
		$entity = $this->get($event->aggregateId());
		$entity->setActivation($event->behaviourActivation());
		$entity->setNames($event->behaviourNames());
		$this->entities[$event->aggregateId()] = $entity;
	}
	
	/**
	 * @param string $uuid
	 * @return Behaviour
	 */
	public function get(string $uuid): Behaviour
	{
		if (false === isset($this->entities[$uuid]))
		{
			throw new \RuntimeException('Behaviour entity not found for uuid: ' . $uuid);
		}
		
		return $this->entities[$uuid];
	}
}