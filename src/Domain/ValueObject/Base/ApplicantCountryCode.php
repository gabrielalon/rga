<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantCountryCode
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $countryCode
	 */
	public function __construct($countryCode)
	{
		$this->value = $countryCode;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}