<?php

namespace RGA\Domain\ValueObject\Base;

final class IndividualNumber
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $number
	 */
	public function __construct($number)
	{
		$this->value = $number;
	}
	
	/**
	 * @return integer
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}