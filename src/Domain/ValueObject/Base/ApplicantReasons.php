<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantReasons
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $applicantReasons
	 */
	public function __construct($applicantReasons)
	{
		$this->value = $applicantReasons;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}