<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantBuildingNumber
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $buildingNumber
	 */
	public function __construct($buildingNumber)
	{
		$this->value = $buildingNumber;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}