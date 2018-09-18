<?php

namespace RGA\Domain\Model\ReturnPackage\ReturnPackage;

use RGA\Application\Assert\Assertion;

final class RgaUuid
{
	/** @var string */
	private $uuid;
	
	/**
	 * @param string $uuid
	 * @return RgaUuid
	 */
	public static function fromString(string $uuid): RgaUuid
	{
		return new RgaUuid($uuid);
	}
	
	/**
	 * @param string $uuid
	 */
	private function __construct(string $uuid)
	{
		Assertion::uuid($uuid, 'Invalid RgaUuid string: ' . $uuid);
		
		$this->uuid = $uuid;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @param RgaUuid $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof RgaUuid)
		{
			return false;
		}
		
		return $this->uuid === $other->uuid;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->uuid;
	}
}