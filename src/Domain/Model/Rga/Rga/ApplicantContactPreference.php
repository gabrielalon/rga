<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class ApplicantContactPreference
{
	/** @var string */
	private $contactPreference;
	
	/**
	 * @param string $contactPreference
	 * @return ApplicantContactPreference
	 */
	public static function fromString(string $contactPreference): ApplicantContactPreference
	{
		return new ApplicantContactPreference($contactPreference);
	}
	
	/**
	 * @param string $contactPreference
	 */
	private function __construct(string $contactPreference)
	{
		Assertion::string($contactPreference, 'Invalid ApplicantContactPreference string: ' . $contactPreference);
		
		$this->contactPreference = $contactPreference;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->contactPreference;
	}
	
	/**
	 * @param ApplicantContactPreference $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ApplicantContactPreference)
		{
			return false;
		}
		
		return $this->contactPreference === $other->contactPreference;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->contactPreference;
	}
}