<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantObjectType
{
	/** @var string */
	private $type;
	
	/**
	 * @param string $type
	 * @return ApplicantObjectType
	 */
	public static function fromString(string $type): ApplicantObjectType
	{
		return new ApplicantObjectType($type);
	}
	
	/**
	 * @param string $type
	 */
	private function __construct(string $type)
	{
		Assertion::string($type, 'Invalid ApplicantObjectType string: ' . $type);
		
		$this->type = $type;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->type;
	}
	
	/**
	 * @param ApplicantObjectType $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantObjectType)
		{
			return false;
		}
		
		return $this->type === $other->type;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->type;
	}
}