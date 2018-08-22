<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantDescriptionOfIncident
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $applicantDescriptionOfIncident
	 */
	public function __construct($applicantDescriptionOfIncident)
	{
		$this->value = $applicantDescriptionOfIncident;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}