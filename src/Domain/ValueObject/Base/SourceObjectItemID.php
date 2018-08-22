<?php

namespace RGA\Domain\ValueObject\Base;

final class SourceObjectItemID
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $sourceObjectItemID
	 */
	public function __construct($sourceObjectItemID)
	{
		$this->value = $sourceObjectItemID;
	}
	
	/**
	 * @return int
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}