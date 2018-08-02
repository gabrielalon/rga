<?php

namespace RGA\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
	/** @var string */
	private $identifier;
	
	/**
	 * @param string $identifier
	 * @throws \InvalidArgumentException
	 */
	public function __construct($identifier)
	{
		if (false === RamseyUuid::isValid($identifier))
		{
			throw new \InvalidArgumentException('uuid_invalid');
		}
		
		$this->identifier = $identifier;
	}
	
	/**
	 * @return string
	 */
	public function getIdentifier()
	{
		return $this->identifier;
	}
}