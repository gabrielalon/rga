<?php

namespace RGA\Domain\ValueObject\Dictionary;

final class IsDeletable
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isDeletable
	 */
	public function __construct($isDeletable)
	{
		$this->value = (bool)$isDeletable;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}