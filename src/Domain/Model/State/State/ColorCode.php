<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class ColorCode
{
	/** @var string */
	private $hex;
	
	/**
	 * @param string $hex
	 * @return ColorCode
	 */
	public static function fromString(string $hex): ColorCode
	{
		return new ColorCode($hex);
	}
	
	/**
	 * @param string $hex
	 */
	private function __construct(string $hex)
	{
		Assertion::regex($hex, '/^#[a-f0-9]{6}$/i', 'Invalid Color hex string: ' . $hex);
		
		$this->hex = $hex;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param ColorCode $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ColorCode)
		{
			return false;
		}
		
		return $this->hex === $other->hex;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->hex;
	}
}