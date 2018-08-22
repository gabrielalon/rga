<?php

namespace RGA\Domain\ValueObject\Base;

final class CreatedAt
{
	/** @var \DateTime */
	private $value;
	
	/**
	 * @param string $createdAt
	 */
	public function __construct($createdAt)
	{
		$this->value = new \DateTime((string)$createdAt);
	}
	
	/**
	 * @return \DateTime
	 */
	public function getValue(): \DateTime
	{
		return $this->value;
	}
}