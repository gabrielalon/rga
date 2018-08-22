<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantGivenProductName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $givenProductName
	 */
	public function __construct($givenProductName)
	{
		$this->value = $givenProductName;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}