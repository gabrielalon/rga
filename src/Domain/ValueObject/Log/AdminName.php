<?php

namespace RGA\Domain\ValueObject\Log;

final class AdminName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $adminName
	 */
	public function __construct($adminName)
	{
		$this->value = $adminName;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}