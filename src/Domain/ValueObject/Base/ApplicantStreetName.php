<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantStreetName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $streetName
	 */
	public function __construct($streetName)
	{
		$this->value = $streetName;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}