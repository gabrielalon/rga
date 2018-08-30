<?php

namespace RGA\Test\Mock\Entity\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour as ValueObject;

class Behaviour
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
	 * @return ValueObject\Uuid
	 */
	public function getUuid(): ValueObject\Uuid
	{
		return $this->uuid;
	}
	
	/**
	 * @param ValueObject\Uuid $uuid
	 * @return Behaviour
	 */
	public function setUuid(ValueObject\Uuid $uuid): Behaviour
	{
		$this->uuid = $uuid;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Type
	 */
	public function getType(): ValueObject\Type
	{
		return $this->type;
	}
	
	/**
	 * @param ValueObject\Type $type
	 * @return Behaviour
	 */
	public function setType(ValueObject\Type $type): Behaviour
	{
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Names
	 */
	public function getNames(): ValueObject\Names
	{
		return $this->names;
	}
	
	/**
	 * @param ValueObject\Names $names
	 * @return Behaviour
	 */
	public function setNames(ValueObject\Names $names): Behaviour
	{
		$this->names = $names;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Activation
	 */
	public function getActivation(): ValueObject\Activation
	{
		return $this->activation;
	}
	
	/**
	 * @param ValueObject\Activation $activation
	 * @return Behaviour
	 */
	public function setActivation(ValueObject\Activation $activation): Behaviour
	{
		$this->activation = $activation;
		
		return $this;
	}
}