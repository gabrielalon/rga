<?php

namespace RGA\Domain\ValueObject\Attachment;

final class FileType
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $type
	 */
	public function __construct($type)
	{
		$this->value = (string)$type;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
}