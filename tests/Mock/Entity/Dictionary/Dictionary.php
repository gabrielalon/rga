<?php

namespace RGA\Test\Mock\Entity\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary as ValueObject;

class Dictionary
{
	/** @var ValueObject\Uuid */
	private $uuid;
	
	/** @var ValueObject\Type */
	private $type;
	
	/** @var ValueObject\Entries */
	private $entries;
	
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
	 * @return ValueObject\Entries
	 */
	public function getEntries(): ValueObject\Entries
	{
		return $this->entries;
	}
	
	/**
	 * @param ValueObject\Entries $entries
	 * @return Dictionary
	 */
	public function setEntries(ValueObject\Entries $entries): Dictionary
	{
		$this->entries = $entries;
		
		return $this;
	}
}