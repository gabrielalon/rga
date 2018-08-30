<?php

namespace RGA\Domain\Model\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour as ValueObject;
use RGA\Domain\Model\Behaviour\Event\ExistingBehaviourChanged;
use RGA\Domain\Model\Behaviour\Event\NewBehaviourCreated;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

final class Behaviour
	extends Aggregate\AggregateRoot
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Type */
	private $type;
	
	/** @var ValueObject\Names */
	private $names;
	
	/** @var ValueObject\Activation */
	private $activation;
	
	/**
	 * @param Behaviour\Uuid $uuid
	 */
	public function setUuid(Behaviour\Uuid $uuid): void
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @param Behaviour\Type $type
	 */
	public function setType(Behaviour\Type $type): void
	{
		$this->type = $type;
	}
	
	/**
	 * @param Behaviour\Names $names
	 */
	public function setNames(Behaviour\Names $names): void
	{
		$this->names = $names;
	}
	
	/**
	 * @param Behaviour\Activation $activation
	 */
	public function setActivation(Behaviour\Activation $activation): void
	{
		$this->activation = $activation;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * @param Behaviour\Uuid $uuid
	 * @param Behaviour\Type $type
	 * @param Behaviour\Names $names
	 * @param Behaviour\Activation $activation
	 * @return Behaviour
	 */
	public static function createNewBehaviour(
		ValueObject\Uuid $uuid,
		ValueObject\Type $type,
		ValueObject\Names $names,
		ValueObject\Activation $activation
	): Behaviour
	{
		$behaviour = new Behaviour();
		
		$behaviour->recordThat(NewBehaviourCreated::occur($uuid->toString(), [
			'type' => $type->toString(),
			'names' => $names->toString(),
			'activation' => $activation->toString()
		]));
		
		return $behaviour;
	}
	
	/**
	 * @param Behaviour\Names $names
	 * @param Behaviour\Activation $activation
	 */
	public function changeExistingBehaviour(
		ValueObject\Names $names,
		ValueObject\Activation $activation
	): void
	{
		$this->recordThat(ExistingBehaviourChanged::occur($this->aggregateId(), [
			'names' => $names->toString(),
			'activation' => $activation->toString()
		]));
	}
}