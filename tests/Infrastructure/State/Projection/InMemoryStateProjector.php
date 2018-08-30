<?php

namespace RGA\Test\Infrastructure\State\Projection;

use RGA\Domain\Model\State\Event;
use RGA\Domain\Model\State\Projection\StateProjectorInterface;
use RGA\Test\Mock\Entity\State\State;

class InMemoryStateProjector
	implements StateProjectorInterface
{
	/** @var  */
	private $states = [];
	
	/**
	 * @param Event\NewStateCreated $event
	 */
	public function onNewStateCreated(Event\NewStateCreated $event): void
	{
		$this->states[$event->stateUuid()->toString()] = (new State())
			->setUuid($event->stateUuid())
			->setIsEditable($event->stateIsEditable())
			->setIsDeletable($event->stateIsDeletable())
			->setIsRejectable($event->stateIsRejectable())
			->setIsFinishable($event->stateIsFinishable())
			->setIsCloseable($event->stateIsCloseable())
			->setIsSendingEmail($event->stateIsSendingEmail())
			->setColorCode($event->stateColorCode())
			->setNames($event->stateNames())
			->setEmailSubjects($event->stateEmailSubjects())
			->setEmailBodies($event->stateEmailBodies());
	}
	
	/**
	 * @param Event\ExistingStateChanged $event
	 */
	public function onExistingStateChanged(Event\ExistingStateChanged $event): void
	{
		$entity = $this->get($event->aggregateId())
			->setIsEditable($event->stateIsEditable())
			->setIsDeletable($event->stateIsDeletable())
			->setIsRejectable($event->stateIsRejectable())
			->setIsFinishable($event->stateIsFinishable())
			->setIsCloseable($event->stateIsCloseable())
			->setIsSendingEmail($event->stateIsSendingEmail())
			->setColorCode($event->stateColorCode())
			->setNames($event->stateNames())
			->setEmailSubjects($event->stateEmailSubjects())
			->setEmailBodies($event->stateEmailBodies());
		
		$this->states[$event->aggregateId()] = $entity;
	}
	
	/**
	 * @param Event\ExistingStateRemoved $event
	 */
	public function onExistingStateRemoved(Event\ExistingStateRemoved $event): void
	{
		unset($this->states[$event->aggregateId()]);
	}
	
	/**
	 * @param string $uuid
	 * @return State
	 */
	public function get(string $uuid): State
	{
		if (false === isset($this->states[$uuid]))
		{
			throw new \RuntimeException('State entity not found for uuid: ' . $uuid);
		}
		
		return $this->states[$uuid];
	}
}