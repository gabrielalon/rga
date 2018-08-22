<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantPostalCode
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $postalCode
	 */
	public function __construct($postalCode)
	{
		$this->value = $postalCode;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}