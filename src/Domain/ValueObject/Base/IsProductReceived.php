<?php

namespace RGA\Domain\ValueObject\Base;

final class IsProductReceived
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isProductReceived
	 */
	public function __construct($isProductReceived)
	{
		$this->value = (bool)$isProductReceived;
	}
	
	/**
	 * @return bool
	 */
	public function getValue(): bool
	{
		return $this->value;
	}
}