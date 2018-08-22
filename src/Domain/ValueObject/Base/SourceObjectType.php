<?php

namespace RGA\Domain\ValueObject\Base;

final class SourceObjectType
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $sourceObjectType
	 */
	public function __construct($sourceObjectType)
	{
		$this->value = (string)$sourceObjectType;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}