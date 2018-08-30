<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantEmail
{
	/** @var string */
	private $email;
	
	/**
	 * @param string $email
	 * @return ApplicantEmail
	 */
	public static function fromString(string $email): ApplicantEmail
	{
		return new ApplicantEmail($email);
	}
	
	/**
	 * @param string $email
	 */
	private function __construct(string $email)
	{
		Assertion::email($email, 'Invalid Applicant email: ' . $email);
		
		$this->email = $email;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->email;
	}
	
	/**
	 * @param ApplicantEmail $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantEmail)
		{
			return false;
		}
		
		return $this->email === $other->email;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->email;
	}
}