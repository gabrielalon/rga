<?php

namespace RGA\Domain\ValueObject\Log;

final class Metadata
{
	/** @var array */
	private $value;
	
	/**
	 * @param array $metadata
	 */
	public function __construct($metadata)
	{
		$this->value = (array)$metadata;
	}
	
	/**
	 * @return array
	 */
	public function getValue(): array
	{
		return $this->value;
	}
}