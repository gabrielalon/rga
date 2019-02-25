<?php

namespace RGA\Domain\Model\Behaviour\Behaviour;

use RGA\Application\Assert\Assertion;

final class Active
{
	/** @var boolean */
	private $active;
	
	/**
	 * @param bool $active
	 * @return Active
	 */
	public static function fromBoolean(bool $active): Active
	{
		return new Active($active);
	}
	
	/**
	 * @param boolean $active
	 */
	private function __construct(bool $active)
	{
		Assertion::boolean($active, 'Invalid Active boolean: ' . $active);
		
		$this->activation = $active;
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
		return $this->activation;
	}
	
	/**
	 * @param Active $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Active)
		{
			return false;
		}
		
		return $this->activation === $other->activation;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->activation ? '1' : '0';
	}
}