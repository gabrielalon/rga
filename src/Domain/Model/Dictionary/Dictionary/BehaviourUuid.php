<?php

namespace RGA\Domain\Model\Dictionary\Dictionary;

use RGA\Application\Assert\Assertion;

final class BehaviourUuid
{
	/** @var string */
	private $uuid;
	
	/**
	 * @param string $uuid
	 * @return BehaviourUuid
	 */
	public static function fromString(string $uuid): BehaviourUuid
	{
		return new BehaviourUuid($uuid);
	}
	
	/**
	 * @param string $uuid
	 */
	private function __construct(string $uuid)
	{
		Assertion::uuid($uuid, 'Invalid BehaviourUuid string: ' . $uuid);
		
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
	 * @param BehaviourUuid $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof BehaviourUuid)
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