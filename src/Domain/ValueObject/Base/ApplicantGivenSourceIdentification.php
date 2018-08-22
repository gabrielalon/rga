<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantGivenSourceIdentification
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $givenSourceIdentification
	 */
	public function __construct($givenSourceIdentification)
	{
		$this->value = $givenSourceIdentification;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}