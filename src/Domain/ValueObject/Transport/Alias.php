<?php

namespace RGA\Domain\ValueObject\Transport;

final class Alias
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $alias
	 */
	public function __construct($alias)
	{
		$this->value = (string)$alias;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}