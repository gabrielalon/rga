<?php

namespace RGA\Domain\Model\Transport;

use RGA\Domain\ValueObject;

class TransportAlias
{
	/** @var string */
	protected $name;
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @param ValueObject\Transport\Alias $name
	 */
	public function setName(ValueObject\Transport\Alias $name): void
	{
		$this->name = $name->getValue();
	}
}