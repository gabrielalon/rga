<?php

namespace RGA\Domain\Model\Rga\Rga;

use RGA\Application\Assert\Assertion;

final class IsDeleted
{
	/** @var boolean */
	private $deleted;
	
	/**
	 * @param bool $activation
	 * @return IsDeleted
	 */
	public static function fromBoolean(bool $activation): IsDeleted
	{
		return new IsDeleted($activation);
	}
	
	/**
	 * @param boolean $activation
	 */
	private function __construct(bool $activation)
	{
		Assertion::boolean($activation, 'Invalid IsDeleted boolean: ' . $activation);
		
		$this->deleted = $activation;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param IsDeleted $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IsDeleted)
		{
			return false;
		}
		
		return $this->deleted === $other->deleted;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->deleted ? '1' : '0';
	}
}