<?php

namespace RGA\Domain\ValueObject\Base;

final class IsCashReturned
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isCashReturned
	 */
	public function __construct($isCashReturned)
	{
		$this->value = (bool)$isCashReturned;
	}
	
	/**
	 * @return bool
	 */
	public function getValue(): bool
	{
		return $this->value;
	}
}