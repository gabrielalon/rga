<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class NettPrice
{
	/** @var float */
	private $price;
	
	/**
	 * @param float $price
	 * @return NettPrice
	 */
	public static function fromFloat(float $price): NettPrice
	{
		return new NettPrice($price);
	}
	
	/**
	 * @param float $price
	 */
	private function __construct(float $price)
	{
		Assertion::float($price, 'Invalid NettPrice float: ' . $price);
		
		$this->price = $price;
	}
	
	/**
	 * @return float
	 */
	public function toString(): float
	{
		return $this->price;
	}
	
	/**
	 * @param NettPrice $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof NettPrice)
		{
			return false;
		}
		
		return $this->price === $other->price;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return (string)$this->price;
	}
}