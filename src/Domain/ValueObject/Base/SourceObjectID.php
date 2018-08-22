<?php

namespace RGA\Domain\ValueObject\Base;

final class SourceObjectID
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $sourceObjectID
	 */
	public function __construct($sourceObjectID)
	{
		$this->value = $sourceObjectID;
	}
	
	/**
	 * @return int
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}