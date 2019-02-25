<?php

namespace RGA\Domain\Model\SegregationSourcing\StorageEvent;

use RGA\Application\Assert\Assertion;

final class Version
{
	/** @var integer */
	private $version;
	
	/**
	 * @param integer $version
	 * @return Version
	 */
	public static function fromInteger(int $version): Version
	{
		return new Version($version);
	}
	
	/**
	 * @param integer $version
	 */
	private function __construct(int $version)
	{
		Assertion::integer($version, 'Invalid Version integer: ' . $version);
		
		$this->version = $version;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->version;
	}
	
	/**
	 * @param Version $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Version)
		{
			return false;
		}
		
		return $this->version === $other->version;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return (string)$this->version;
	}
}