<?php

namespace RGA\Domain\ValueObject\Transport;

final class CourierSymbol
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $courierSymbol
	 */
	public function __construct($courierSymbol)
	{
		$this->value = (string)$courierSymbol;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}