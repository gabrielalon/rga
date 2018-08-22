<?php

namespace RGA\Domain\ValueObject\Base;

final class ProductVariantID
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $productVariantID
	 */
	public function __construct($productVariantID)
	{
		$this->value = $productVariantID;
	}
	
	/**
	 * @return int
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}