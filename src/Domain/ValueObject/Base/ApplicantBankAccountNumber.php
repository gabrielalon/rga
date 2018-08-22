<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantBankAccountNumber
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $bankAccountNumber
	 */
	public function __construct($bankAccountNumber)
	{
		$this->value = $bankAccountNumber;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}