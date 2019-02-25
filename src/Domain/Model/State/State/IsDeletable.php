<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class IsDeletable
{
	/** @var boolean */
	private $deletable;
	
	/**
	 * @param bool $deletable
	 * @return IsDeletable
	 */
	public static function fromBoolean(bool $deletable): IsDeletable
	{
		return new IsDeletable($deletable);
	}
	
	/**
	 * @param boolean $deletable
	 */
	private function __construct(bool $deletable)
	{
		Assertion::boolean($deletable, 'Invalid IsDeletable boolean: ' . $deletable);
		
		$this->deletable = $deletable;
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
		return $this->deletable;
	}
	
	/**
	 * @param IsDeletable $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IsDeletable)
		{
			return false;
		}
		
		return $this->deletable === $other->deletable;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->deletable ? '1' : '0';
	}
}