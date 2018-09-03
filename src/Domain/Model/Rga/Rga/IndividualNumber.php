<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class IndividualNumber
{
	/** @var string */
	private $individualNumber;
	
	/**
	 * @param integer $individualNumber
	 * @return IndividualNumber
	 */
	public static function fromInteger(int $individualNumber): IndividualNumber
	{
		return new IndividualNumber($individualNumber);
	}
	
	/**
	 * @param integer $individualNumber
	 */
	private function __construct(int $individualNumber)
	{
		Assertion::integer($individualNumber, 'Invalid IndividualNumber string: ' . $individualNumber);
		
		$this->individualNumber = $individualNumber;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->individualNumber;
	}
	
	/**
	 * @param IndividualNumber $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IndividualNumber)
		{
			return false;
		}
		
		return $this->individualNumber === $other->individualNumber;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return (string)$this->individualNumber;
	}
}