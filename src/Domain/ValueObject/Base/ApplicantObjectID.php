<?php

namespace RGA\Domain\ValueObject\Base;

final class ApplicantObjectID
{
	/** @var integer */
	private $value;
	
	/**
	 * @param integer $objectID
	 */
	public function __construct($objectID)
	{
		$this->value = $objectID;
	}
	
	/**
	 * @return integer
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}