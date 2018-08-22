<?php

namespace RGA\Application\Enum;

abstract class AbstractEnum
{
	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function getAvailableTypes(): array
	{
		$reflection = new \ReflectionClass($this);
		
		return $reflection->getConstants();
	}
	
	/**
	 * @param string $type
	 * @return bool
	 */
	public static function isValid($type): bool
	{
		$class = \get_called_class();
		/** @var AbstractEnum $enum */
		$enum = new $class();
		
		try
		{
			return in_array($type, $enum->getAvailableTypes());
		}
		catch (\ReflectionException $e)
		{
			return false;
		}
	}
}