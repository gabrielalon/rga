<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class PackageSentAt
{
	/** @var string */
	private $date;
	
	/**
	 * @param string $date
	 * @return PackageSentAt
	 */
	public static function fromString(string $date): PackageSentAt
	{
		return new PackageSentAt($date);
	}
	
	/**
	 * @param string $date
	 */
	private function __construct(string $date)
	{
		Assertion::date($date, 'Y-m-d H:i:s', 'Invalid PackageSentAt string: ' . $date);
		
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
	 * @param PackageSentAt $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof PackageSentAt)
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