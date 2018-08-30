<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantBuildingNumber
{
	/** @var string */
	private $buildingNumber;
	
	/**
	 * @param string $buildingNumber
	 * @return ApplicantBuildingNumber
	 */
	public static function fromString(string $buildingNumber): ApplicantBuildingNumber
	{
		return new ApplicantBuildingNumber($buildingNumber);
	}
	
	/**
	 * @param string $buildingNumber
	 */
	private function __construct(string $buildingNumber)
	{
		Assertion::string($buildingNumber, 'Invalid ApplicantBuildingNumber string: ' . $buildingNumber);
		
		$this->buildingNumber = $buildingNumber;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->buildingNumber;
	}
	
	/**
	 * @param ApplicantBuildingNumber $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantBuildingNumber)
		{
			return false;
		}
		
		return $this->buildingNumber === $other->buildingNumber;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->buildingNumber;
	}
}