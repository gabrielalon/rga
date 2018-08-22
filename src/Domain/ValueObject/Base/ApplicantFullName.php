<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantFullName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $fullName
	 */
	public function __construct($fullName)
	{
		$this->value = $fullName;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}