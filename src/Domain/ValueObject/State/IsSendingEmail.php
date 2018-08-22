<?php

namespace RGA\Domain\ValueObject\State;

final class IsSendingEmail
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isSendingEmail
	 */
	public function __construct($isSendingEmail)
	{
		$this->value = (bool)$isSendingEmail;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}