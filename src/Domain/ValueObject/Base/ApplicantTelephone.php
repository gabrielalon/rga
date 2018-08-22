<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantTelephone
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $telephone
	 */
	public function __construct($telephone)
	{
		$this->value = $telephone;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}