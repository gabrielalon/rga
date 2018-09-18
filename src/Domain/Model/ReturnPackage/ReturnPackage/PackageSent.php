<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class PackageSent
{
	/** @var boolean */
	private $sent;
	
	/**
	 * @param bool $activation
	 * @return PackageSent
	 */
	public static function fromBoolean(bool $activation): PackageSent
	{
		return new PackageSent($activation);
	}
	
	/**
	 * @param boolean $activation
	 */
	private function __construct(bool $activation)
	{
		Assertion::boolean($activation, 'Invalid PackageSent boolean: ' . $activation);
		
		$this->sent = $activation;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param PackageSent $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof PackageSent)
		{
			return false;
		}
		
		return $this->sent === $other->sent;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->sent ? '1' : '0';
	}
}