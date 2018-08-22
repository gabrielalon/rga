<?php

namespace RGA\Domain\ValueObject\State;

final class EmailSubject
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $emailSubject
	 */
	public function __construct($emailSubject)
	{
		$this->value = (string)$emailSubject;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}