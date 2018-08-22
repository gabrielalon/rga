<?php

namespace RGA\Domain\ValueObject\Base;

final class PackageSentAt
{
	/** @var \DateTime */
	private $value;
	
	/**
	 * @param string $packageSentAt
	 */
	public function __construct($packageSentAt)
	{
		$this->value = new \DateTime((string)$packageSentAt);
	}
	
	/**
	 * @return \DateTime
	 */
	public function getValue(): \DateTime
	{
		return $this->value;
	}
}