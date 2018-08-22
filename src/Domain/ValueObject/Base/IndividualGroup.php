<?php

namespace RGA\Domain\ValueObject\Base;

final class IndividualGroup
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $group
	 */
	public function __construct($group)
	{
		$this->value = $group;
	}
	
	/**
	 * @return integer
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}