<?php

namespace RGA\Domain\ValueObject\Base;

final class ProductName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $productName
	 */
	public function __construct($productName)
	{
		$this->value = (string)$productName;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}