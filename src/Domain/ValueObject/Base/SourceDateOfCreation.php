<?php

namespace RGA\Domain\ValueObject\Base;

final class SourceDateOfCreation
{
	/** @var \DateTime */
	private $value;
	
	/**
	 * @param string $sourceDateOfCreation
	 */
	public function __construct($sourceDateOfCreation)
	{
		$this->value = new \DateTime((string)$sourceDateOfCreation);
	}
	
	/**
	 * @return \DateTime
	 */
	public function getValue(): \DateTime
	{
		return $this->value;
	}
}