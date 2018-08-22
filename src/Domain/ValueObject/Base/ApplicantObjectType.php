<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantObjectType
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $objectType
	 */
	public function __construct($objectType)
	{
		$this->value = $objectType;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}