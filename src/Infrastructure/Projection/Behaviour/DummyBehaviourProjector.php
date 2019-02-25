<?php

namespace RGA\Infrastructure\Projection\Behaviour;

use RGA\Application\Behaviour\Event;
use RGA\Domain\Model\Behaviour\Projection;

class DummyBehaviourProjector
	implements Projection\BehaviourProjectorInterface
{
	
	/**
	 * @param Event\NewBehaviourCreated $event
	 */
	public function onNewBehaviourCreated(Event\NewBehaviourCreated $event): void
	{
		// TODO: Implement onNewBehaviourCreated() method.
	}
	
	/**
	 * @param Event\ExistingBehaviourChanged $event
	 */
	public function onExistingBehaviourChanged(Event\ExistingBehaviourChanged $event): void
	{
		// TODO: Implement onExistingBehaviourChanged() method.
	}
}