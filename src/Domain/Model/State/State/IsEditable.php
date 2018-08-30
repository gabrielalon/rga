<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class IsEditable
{
	/** @var boolean */
	private $editable;
	
	/**
	 * @param bool $editable
	 * @return IsEditable
	 */
	public static function fromBoolean(bool $editable): IsEditable
	{
		return new IsEditable($editable);
	}
	
	/**
	 * @param boolean $editable
	 */
	private function __construct(bool $editable)
	{
		Assertion::boolean($editable, 'Invalid IsEditable boolean: ' . $editable);
		
		$this->editable = $editable;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param IsEditable $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IsEditable)
		{
			return false;
		}
		
		return $this->editable === $other->editable;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->editable ? '1' : '0';
	}
}