<?php

namespace RGA\Domain\Model\State\State;

use RGA\Application\Assert\Assertion;

final class IsSendingEmail
{
	/** @var boolean */
	private $sendingEmail;
	
	/**
	 * @param bool $sendingEmail
	 * @return IsSendingEmail
	 */
	public static function fromBoolean(bool $sendingEmail): IsSendingEmail
	{
		return new IsSendingEmail($sendingEmail);
	}
	
	/**
	 * @param boolean $sendingEmail
	 */
	private function __construct(bool $sendingEmail)
	{
		Assertion::boolean($sendingEmail, 'Invalid IsSendingEmail boolean: ' . $sendingEmail);
		
		$this->sendingEmail = $sendingEmail;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param IsSendingEmail $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof IsSendingEmail)
		{
			return false;
		}
		
		return $this->sendingEmail === $other->sendingEmail;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->sendingEmail ? '1' : '0';
	}
}