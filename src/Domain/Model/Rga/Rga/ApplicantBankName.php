<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantBankName
{
	/** @var string */
	private $bankName;
	
	/**
	 * @param string $bankName
	 * @return ApplicantBankName
	 */
	public static function fromString(string $bankName): ApplicantBankName
	{
		return new ApplicantBankName($bankName);
	}
	
	/**
	 * @param string $bankName
	 */
	private function __construct(string $bankName)
	{
		Assertion::string($bankName, 'Invalid ApplicantBankName string: ' . $bankName);
		
		$this->bankName = $bankName;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->bankName;
	}
	
	/**
	 * @param ApplicantBankName $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantBankName)
		{
			return false;
		}
		
		return $this->bankName === $other->bankName;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->bankName;
	}
}