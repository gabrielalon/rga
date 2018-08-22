<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantCity
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $city
	 */
	public function __construct($city)
	{
		$this->value = $city;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}