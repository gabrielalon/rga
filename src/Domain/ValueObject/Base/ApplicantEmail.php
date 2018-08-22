<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantEmail
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $email
	 */
	public function __construct($email)
	{
		$this->value = $email;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}