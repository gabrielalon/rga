<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class SourceDateOfCreation
{
	/** @var string */
	private $date;
	
	/**
	 * @param string $date
	 * @return SourceDateOfCreation
	 */
	public static function fromString(string $date): SourceDateOfCreation
	{
		return new SourceDateOfCreation($date);
	}
	
	/**
	 * @param string $date
	 */
	private function __construct(string $date)
	{
		Assertion::date($date, 'Y-m-d H:i:s', 'Invalid SourceDateOfCreation string: ' . $date);
		
		$this->date = $date;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->date;
	}
	
	/**
	 * @param SourceDateOfCreation $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof SourceDateOfCreation)
		{
			return false;
		}
		
		return $this->date === $other->date;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->date;
	}
}