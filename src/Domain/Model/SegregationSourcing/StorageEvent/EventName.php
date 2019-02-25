<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class EventName
{
	/** @var string */
	private $name;
	
	/**
	 * @param string $name
	 * @return EventName
	 */
	public static function fromString(string $name): EventName
	{
		return new EventName($name);
	}
	
	/**
	 * @param string $name
	 */
	private function __construct(string $name)
	{
		Assertion::string($name, 'Invalid EventName string: ' . $name);
		
		$this->name = $name;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->name;
	}
	
	/**
	 * @param EventName $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof EventName)
		{
			return false;
		}
		
		return $this->name === $other->name;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->name;
	}
}