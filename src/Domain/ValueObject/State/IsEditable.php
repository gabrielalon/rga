<?php

namespace RGA\Domain\ValueObject\State;

final class IsEditable
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isEditable
	 */
	public function __construct($isEditable)
	{
		$this->value = (bool)$isEditable;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}