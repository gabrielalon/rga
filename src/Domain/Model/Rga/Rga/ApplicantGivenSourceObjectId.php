<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantGivenSourceObjectId
{
	/** @var string */
	private $givenId;
	
	/**
	 * @param string $givenId
	 * @return ApplicantGivenSourceObjectId
	 */
	public static function fromString(string $givenId): ApplicantGivenSourceObjectId
	{
		return new ApplicantGivenSourceObjectId($givenId);
	}
	
	/**
	 * @param string $givenId
	 */
	private function __construct(string $givenId)
	{
		Assertion::string($givenId, 'Invalid ApplicantGivenSourceObjectId string: ' . $givenId);
		
		$this->givenId = $givenId;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->givenId;
	}
	
	/**
	 * @param ApplicantGivenSourceObjectId $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantGivenSourceObjectId)
		{
			return false;
		}
		
		return $this->givenId === $other->givenId;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->givenId;
	}
}