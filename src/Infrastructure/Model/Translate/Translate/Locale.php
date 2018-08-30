<?php

namespace RGA\Infrastructure\Model\Translate\Translate;

use RGA\Application\Assert\Assertion;
use RGA\Infrastructure\Model\Translate\Enum;
use RGA\Infrastructure\Model\Translate\Exception;

final class Locale
{
	/** @var string */
	private $locale;
	
	/**
	 * @param string $locale
	 * @return Locale
	 */
	public static function fromString(string $locale): Locale
	{
		return new Locale($locale);
	}
	
	/**
	 * @param string $locale
	 */
	private function __construct(string $locale)
	{
		Assertion::inArray($locale, (new Enum\Locale())->getConstList(), 'Invalid Locale string: ' . $locale);
		
		$this->locale = $locale;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param Locale $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Locale)
		{
			return false;
		}
		
		return $this->locale === $other->locale;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->locale;
	}
}