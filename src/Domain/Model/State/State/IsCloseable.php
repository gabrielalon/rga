<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class IsCloseable
{
	/** @var boolean */
	private $closeable;
	
	/**
	 * @param bool $closeable
	 * @return IsCloseable
	 */
	public static function fromBoolean(bool $closeable): IsCloseable
	{
		return new IsCloseable($closeable);
	}
	
	/**
	 * @param boolean $closeable
	 */
	private function __construct(bool $closeable)
	{
		Assertion::boolean($closeable, 'Invalid IsCloseable boolean: ' . $closeable);
		
		$this->closeable = $closeable;
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
		return $this->closeable;
	}
	
	/**
	 * @param IsCloseable $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IsCloseable)
		{
			return false;
		}
		
		return $this->closeable === $other->closeable;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->closeable ? '1' : '0';
	}
}