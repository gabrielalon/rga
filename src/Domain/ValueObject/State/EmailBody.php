<?php

namespace RGA\Domain\ValueObject\State;

final class EmailBody
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $emailBody
	 */
	public function __construct($emailBody)
	{
		$this->value = (string)$emailBody;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}