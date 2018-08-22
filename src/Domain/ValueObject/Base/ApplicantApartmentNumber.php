<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantApartmentNumber
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $apartmentNumber
	 */
	public function __construct($apartmentNumber)
	{
		$this->value = $apartmentNumber;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}