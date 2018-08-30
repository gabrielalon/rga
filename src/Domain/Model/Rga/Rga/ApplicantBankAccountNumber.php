<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantBankAccountNumber
{
	/** @var string */
	private $bankAccountNumber;
	
	/**
	 * @param string $bankAccountNumber
	 * @return ApplicantBankAccountNumber
	 */
	public static function fromString(string $bankAccountNumber): ApplicantBankAccountNumber
	{
		return new ApplicantBankAccountNumber($bankAccountNumber);
	}
	
	/**
	 * @param string $bankAccountNumber
	 */
	private function __construct(string $bankAccountNumber)
	{
		Assertion::string($bankAccountNumber, 'Invalid ApplicantBankAccountNumber string: ' . $bankAccountNumber);
		
		$this->bankAccountNumber = $bankAccountNumber;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->bankAccountNumber;
	}
	
	/**
	 * @param ApplicantBankAccountNumber $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantBankAccountNumber)
		{
			return false;
		}
		
		return $this->bankAccountNumber === $other->bankAccountNumber;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->bankAccountNumber;
	}
}