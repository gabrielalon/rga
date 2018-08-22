<?php

namespace RGA\Domain\ValueObject\Base;

final class IsProductReturned
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isProductReturned
	 */
	public function __construct($isProductReturned)
	{
		$this->value = (bool)$isProductReturned;
	}
	
	/**
	 * @return bool
	 */
	public function getValue(): bool
	{
		return $this->value;
	}
}