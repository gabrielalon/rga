<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class Payload
{
	/** @var array */
	private $payload;
	
	/**
	 * @param string $payload
	 * @return Payload
	 */
	public static function fromString(string $payload): Payload
	{
		return new Payload($payload);
	}
	
	/**
	 * @param string $payload
	 */
	private function __construct(string $payload)
	{
		Assertion::string($payload, 'Invalid Payload string: ' . $payload);
		
		$this->payload = (array)@\json_decode($payload, true);
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @return array
	 */
	public function raw(): array
	{
		return $this->payload;
	}
	
	/**
	 * @param Payload $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Payload)
		{
			return false;
		}
		
		return $this->payload === $other->payload;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return \json_encode($this->payload);
	}
}