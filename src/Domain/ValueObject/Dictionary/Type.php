<?php

namespace RGA\Domain\ValueObject\Dictionary;

final class Type
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $type
	 */
	public function __construct($type)
	{
		$this->value = (string)$type;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}