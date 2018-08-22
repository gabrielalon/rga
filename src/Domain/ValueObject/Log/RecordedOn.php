<?php

namespace RGA\Domain\ValueObject\Log;

final class RecordedOn
{
	/** @var \DateTime */
	private $value;
	
	/**
	 * @param string $recordedOn
	 */
	public function __construct($recordedOn)
	{
		$this->value = new \DateTime((string)$recordedOn);
	}
	
	/**
	 * @return \DateTime
	 */
	public function getValue(): \DateTime
	{
		return $this->value;
	}
}