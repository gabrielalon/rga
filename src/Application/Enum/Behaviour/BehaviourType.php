<?php

namespace RGA\Application\Enum\Behaviour;

class BehaviourType
{
	const COMPLAINT_TYPE = 'complaint';
	const RETURN_TYPE = 'return';
	
	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function getAvailableTypes()
	{
		$reflection = new \ReflectionClass($this);
		
		return $reflection->getConstants();
	}
	
	/**
	 * @param string $type
	 * @return bool
	 */
	public static function isValid($type)
	{
		$enum = new BehaviourType();
		
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