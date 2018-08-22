<?php

namespace RGA\Domain\ValueObject\Dictionary;

final class Entry
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $entry
	 */
	public function __construct($entry)
	{
		$this->value = (string)$entry;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}