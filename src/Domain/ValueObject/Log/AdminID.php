<?php

namespace RGA\Domain\ValueObject\Log;

final class AdminID
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $adminID
	 */
	public function __construct($adminID)
	{
		$this->value = $adminID;
	}
	
	/**
	 * @return int
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}