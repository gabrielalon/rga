<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantContactPreference
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $applicantContactPreference
	 */
	public function __construct($applicantContactPreference)
	{
		$this->value = $applicantContactPreference;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}