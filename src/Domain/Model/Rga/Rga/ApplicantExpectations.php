<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantExpectations
{
	/** @var string */
	private $expectations;
	
	/**
	 * @param string $expectations
	 * @return ApplicantExpectations
	 */
	public static function fromString(string $expectations): ApplicantExpectations
	{
		return new ApplicantExpectations($expectations);
	}
	
	/**
	 * @param string $expectations
	 */
	private function __construct(string $expectations)
	{
		Assertion::string($expectations, 'Invalid ApplicantExpectations string: ' . $expectations);
		
		$this->expectations = $expectations;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->expectations;
	}
	
	/**
	 * @param ApplicantExpectations $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantExpectations)
		{
			return false;
		}
		
		return $this->expectations === $other->expectations;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->expectations;
	}
}