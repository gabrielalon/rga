<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class EventId
{
	/** @var string */
	private $id;
	
	/**
	 * @param string $id
	 * @return EventId
	 */
	public static function fromString(string $id): EventId
	{
		return new EventId($id);
	}
	
	/**
	 * @param string $id
	 */
	private function __construct(string $id)
	{
		Assertion::string($id, 'Invalid EventId string: ' . $id);
		
		$this->id = $id;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->id;
	}
	
	/**
	 * @param EventId $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof EventId)
		{
			return false;
		}
		
		return $this->id === $other->id;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->id;
	}
}