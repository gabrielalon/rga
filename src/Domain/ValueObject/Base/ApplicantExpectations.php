<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantExpectations
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $applicantExpectations
	 */
	public function __construct($applicantExpectations)
	{
		$this->value = $applicantExpectations;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}