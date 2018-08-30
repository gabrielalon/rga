<?php

namespace RGA\Domain\Model\Transport\Transport;

use RGA\Application\Assert\Assertion;

final class Activation
{
	/** @var boolean */
	private $activation;
	
	/**
	 * @param bool $activation
	 * @return Activation
	 */
	public static function fromBoolean(bool $activation): Activation
	{
		return new Activation($activation);
	}
	
	/**
	 * @param boolean $activation
	 */
	private function __construct(bool $activation)
	{
		Assertion::boolean($activation, 'Invalid Activation boolean: ' . $activation);
		
		$this->activation = $activation;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param Activation $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Activation)
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