<?php

namespace RGA\Domain\ValueObject\Attachment;

final class OriginalFileName
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->value = (string)$name;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}