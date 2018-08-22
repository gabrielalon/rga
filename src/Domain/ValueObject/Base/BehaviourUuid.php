<?php

namespace RGA\Domain\ValueObject\Base;

final class BehaviourUuid
{
	/** @var string */
	private $value;
	
	/**
	 * @param string $uuid
	 */
	public function __construct($uuid)
	{
		$this->value = (string)$uuid;
	}
	
	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}