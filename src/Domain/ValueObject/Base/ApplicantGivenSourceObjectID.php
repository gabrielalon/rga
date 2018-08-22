<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantGivenSourceObjectID
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $givenSourceObjectID
	 */
	public function __construct($givenSourceObjectID)
	{
		$this->value = $givenSourceObjectID;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}