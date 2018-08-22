<?php

namespace RGA\Domain\ValueObject\Base;

final class IsDeleted
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isDeleted
	 */
	public function __construct($isDeleted)
	{
		$this->value = (bool)$isDeleted;
	}
	
	/**
	 * @return bool
	 */
	public function getValue(): bool
	{
		return $this->value;
	}
}