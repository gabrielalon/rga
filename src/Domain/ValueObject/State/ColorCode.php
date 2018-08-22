<?php

namespace RGA\Domain\ValueObject\State;

final class ColorCode
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $colorCode
	 */
	public function __construct($colorCode)
	{
		$this->value = (string)$colorCode;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}