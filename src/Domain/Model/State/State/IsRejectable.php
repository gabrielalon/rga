<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class IsRejectable
{
	/** @var boolean */
	private $rejectable;
	
	/**
	 * @param bool $rejectable
	 * @return IsRejectable
	 */
	public static function fromBoolean(bool $rejectable): IsRejectable
	{
		return new IsRejectable($rejectable);
	}
	
	/**
	 * @param boolean $rejectable
	 */
	private function __construct(bool $rejectable)
	{
		Assertion::boolean($rejectable, 'Invalid IsRejectable boolean: ' . $rejectable);
		
		$this->rejectable = $rejectable;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @return bool
	 */
	public function raw(): bool
	{
		return $this->rejectable;
	}
	
	/**
	 * @param IsRejectable $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IsRejectable)
		{
			return false;
		}
		
		return $this->rejectable === $other->rejectable;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->rejectable ? '1' : '0';
	}
}