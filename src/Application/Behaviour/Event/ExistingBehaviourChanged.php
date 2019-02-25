<?php

namespace RGA\Application\Behaviour\Event;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class ExistingBehaviourChanged
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Behaviour\Names
	 */
	public function behaviourNames(): Behaviour\Names
	{
		return Behaviour\Names::fromArray((array)($this->payload['names'] ? \unserialize($this->payload['names'], ['allowed_classes' => false]) : []));
	}
	
	/**
	 * @return Behaviour\Active
	 */
	public function behaviourActivation(): Behaviour\Active
	{
		return Behaviour\Active::fromBoolean((bool)($this->payload['activation'] ?? false));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Behaviour $behaviour
	 */
	public function populate(Aggregate\AggregateRoot $behaviour): void
	{
		$behaviour->setNames($this->behaviourNames());
		$behaviour->setActivation($this->behaviourActivation());
	}
}