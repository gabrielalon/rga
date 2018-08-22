<?php

namespace RGA\Domain\ValueObject\Base;

final class PackageSent
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $packageSent
	 */
	public function __construct($packageSent)
	{
		$this->value = (bool)$packageSent;
	}
	
	/**
	 * @return bool
	 */
	public function getValue(): bool
	{
		return $this->value;
	}
}