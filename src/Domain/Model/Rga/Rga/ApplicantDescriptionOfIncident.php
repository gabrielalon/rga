<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantDescriptionOfIncident
{
	/** @var string */
	private $descriptionOfIncident;
	
	/**
	 * @param string $descriptionOfIncident
	 * @return ApplicantDescriptionOfIncident
	 */
	public static function fromString(string $descriptionOfIncident): ApplicantDescriptionOfIncident
	{
		return new ApplicantDescriptionOfIncident($descriptionOfIncident);
	}
	
	/**
	 * @param string $descriptionOfIncident
	 */
	private function __construct(string $descriptionOfIncident)
	{
		Assertion::string($descriptionOfIncident, 'Invalid ApplicantDescriptionOfIncident string: ' . $descriptionOfIncident);
		
		$this->descriptionOfIncident = $descriptionOfIncident;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->descriptionOfIncident;
	}
	
	/**
	 * @param ApplicantDescriptionOfIncident $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantDescriptionOfIncident)
		{
			return false;
		}
		
		return $this->descriptionOfIncident === $other->descriptionOfIncident;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->descriptionOfIncident;
	}
}