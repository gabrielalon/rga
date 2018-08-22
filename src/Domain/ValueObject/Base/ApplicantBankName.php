<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantBankName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $bankName
	 */
	public function __construct($bankName)
	{
		$this->value = $bankName;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}