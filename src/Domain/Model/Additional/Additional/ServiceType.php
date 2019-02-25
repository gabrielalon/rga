<?php

namespace RGA\Domain\Model\Additional\Additional;

use RGA\Application\Assert\Assertion;

final class ServiceType
{
	/** @var string */
	private $serviceType;
	
	/**
	 * @param string $serviceType
	 * @return ServiceType
	 */
	public static function fromString(string $serviceType): ServiceType
	{
		return new ServiceType($serviceType);
	}
	
	/**
	 * @param string $serviceType
	 */
	private function __construct(string $serviceType)
	{
		Assertion::string($serviceType, 'Invalid ServiceType string: ' . $serviceType);
		
		$this->serviceType = $serviceType;
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->__toString();
	}
	
	/**
	 * @param ServiceType $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof ServiceType)
		{
			return false;
		}
		
		return $this->serviceType === $other->serviceType;
	}
	
	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->serviceType;
	}
}