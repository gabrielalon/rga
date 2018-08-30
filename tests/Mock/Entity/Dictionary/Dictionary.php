<?php

namespace RGA\Test\Mock\Entity\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary as ValueObject;

class Dictionary
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Type */
	private $type;
	
	/** @var ValueObject\Values */
	private $values;
	
	/**
	 * @return ValueObject\Uuid
	 */
	public function getUuid(): ValueObject\Uuid
	{
		return $this->uuid;
	}
	
	/**
	 * @param ValueObject\Uuid $uuid
	 * @return Dictionary
	 */
	public function setUuid(ValueObject\Uuid $uuid): Dictionary
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
	 * @return Dictionary
	 */
	public function setType(ValueObject\Type $type): Dictionary
	{
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * @return ValueObject\Values
	 */
	public function getValues(): ValueObject\Values
	{
		return $this->values;
	}
	
	/**
	 * @param ValueObject\Values $values
	 * @return Dictionary
	 */
	public function setValues(ValueObject\Values $values): Dictionary
	{
		$this->values = $values;
		
		return $this;
	}
}