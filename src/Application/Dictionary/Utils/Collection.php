<?php

namespace RGA\Application\Dictionary\Utils;

use RGA\Domain\Model\Dictionary\Dictionary\BehaviourUuid;

class Collection
	extends \ArrayIterator
{
	/**
	 * @param BehaviourUuid $domain
	 */
	public function add(BehaviourUuid $domain): void
	{
		$this->offsetSet($domain->toString(), $domain);
	}
	
	/**
	 * @param BehaviourUuid $domain
	 * @return bool
	 */
	public function has(BehaviourUuid $domain): bool
	{
		/** @var BehaviourUuid $tmpBehaviourUuid */
		foreach ($this->getArrayCopy() as $tmpBehaviourUuid)
		{
			if (true === $tmpBehaviourUuid->equals($domain))
			{
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * @param Collection $other
	 * @return bool
	 */
	public function equals($other): bool
	{
		if (false === $other instanceof Collection)
		{
			return false;
		}
		
		/** @var BehaviourUuid $domain */
		foreach ($this->getArrayCopy() as $domain)
		{
			if (false === $other->has($domain))
			{
				return false;
			}
		}
		
		return true;
	}
}