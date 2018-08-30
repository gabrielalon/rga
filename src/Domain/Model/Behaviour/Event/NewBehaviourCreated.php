<?php

namespace RGA\Domain\Model\Behaviour\Event;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Domain\Model\Behaviour\Enum;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class NewBehaviourCreated
	extends Aggregate\EventBridge\AggregateChanged
{
	/**
	 * @return Behaviour\Uuid
	 */
	public function behaviourUuid(): Behaviour\Uuid
	{
		return Behaviour\Uuid::fromString($this->aggregateId());
	}
	
	/**
	 * @return Behaviour\Type
	 */
	public function behaviourType(): Behaviour\Type
	{
		return Behaviour\Type::fromString((string)($this->payload['type'] ?? Enum\Type::__default));
	}
	
	/**
	 * @return Behaviour\Names
	 */
	public function behaviourNames(): Behaviour\Names
	{
		return Behaviour\Names::fromArray((array)(\json_decode($this->payload['names'], true) ?? []));
	}
	
	/**
	 * @return Behaviour\Activation
	 */
	public function behaviourActivation(): Behaviour\Activation
	{
		return Behaviour\Activation::fromBoolean((bool)($this->payload['activation'] ?? false));
	}
	
	/**
	 * @param Aggregate\AggregateRoot|Behaviour $behaviour
	 */
	public function populate(Aggregate\AggregateRoot $behaviour): void
	{
		$behaviour->setUuid($this->behaviourUuid());
		$behaviour->setNames($this->behaviourNames());
		$behaviour->setType($this->behaviourType());
		$behaviour->setActivation($this->behaviourActivation());
	}
}