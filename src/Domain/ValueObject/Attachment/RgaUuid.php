<?php

namespace RGA\Domain\ValueObject\Attachment;

final class RgaUuid
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