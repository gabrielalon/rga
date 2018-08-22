<?php

namespace RGA\Domain\ValueObject\Base;

final class PackageNo
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $packageNo
	 */
	public function __construct($packageNo)
	{
		$this->value = $packageNo;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}