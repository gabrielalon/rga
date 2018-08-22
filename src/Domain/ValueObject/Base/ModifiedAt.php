<?php

namespace RGA\Domain\ValueObject\Base;

final class ModifiedAt
{
	/** @var \DateTime */
	private $value;
	
	/**
	 * @param string $modifiedAt
	 */
	public function __construct($modifiedAt)
	{
		$this->value = new \DateTime((string)$modifiedAt);
	}
	
	/**
	 * @return \DateTime
	 */
	public function getValue(): \DateTime
	{
		return $this->value;
	}
}