<?php

namespace RGA\Domain\Model\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour as VO;
use RGA\Application\Behaviour\Event\ExistingBehaviourChanged;
use RGA\Application\Behaviour\Event\NewBehaviourCreated;
use RGA\Infrastructure\SegregationSourcing\Aggregate;

class Behaviour
	extends Aggregate\AggregateRoot
{
	/** @var VO\Uuid */
	protected $uuid;
	
	/** @var VO\Type */
	protected $type;
	
	/** @var VO\Names */
	protected $names;
	
	/** @var VO\Active */
	protected $active;
	
	/**
	 * @param Behaviour\Uuid $uuid
	 * @return Behaviour
	 */
	public function setUuid(Behaviour\Uuid $uuid): Behaviour
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @param Behaviour\Type $type
	 * @return Behaviour
	 */
	public function setType(Behaviour\Type $type): Behaviour
	{
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * @param Behaviour\Names $names
	 * @return Behaviour
	 */
	public function setNames(Behaviour\Names $names): Behaviour
	{
		$this->names = $names;
		
		return $this;
	}
	
	/**
	 * @param Behaviour\Active $active
	 * @return Behaviour
	 */
	public function setActivation(Behaviour\Active $active): Behaviour
	{
		$this->active = $active;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function aggregateId(): string
	{
		return $this->uuid->toString();
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setAggregateId($id): void
	{
		$this->setUuid(VO\Uuid::fromString($id));
	}
	
	/**
	 * @param Behaviour\Uuid $uuid
	 * @param Behaviour\Type $type
	 * @param Behaviour\Names $names
	 * @param Behaviour\Active $activation
	 * @return Behaviour
	 */
	public static function createNewBehaviour(
		VO\Uuid $uuid,
		VO\Type $type,
		VO\Names $names,
		VO\Active $activation
	): Behaviour
	{
		$behaviour = new Behaviour();
		
		$behaviour->recordThat(NewBehaviourCreated::occur($uuid->toString(), [
			'type' => $type->toString(),
			'names' => $names->toString(),
			'activation' => $activation->raw()
		]));
		
		return $behaviour;
	}
	
	/**
	 * @param Behaviour\Names $names
	 * @param Behaviour\Active $activation
	 */
	public function changeExistingBehaviour(
		VO\Names $names,
		VO\Active $activation
	): void
	{
		$this->recordThat(ExistingBehaviourChanged::occur($this->aggregateId(), [
			'names' => $names->toString(),
			'activation' => $activation->raw()
		]));
	}
}