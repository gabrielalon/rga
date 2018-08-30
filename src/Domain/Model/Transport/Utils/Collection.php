<?php

namespace RGA\Domain\Model\Transport\Utils;

use RGA\Domain\Model\Transport\Transport\Domain;

class Collection
	extends \ArrayIterator
{
	/**
	 * @param Domain $domain
	 */
	public function add(Domain $domain): void
	{
		$this->append($domain);
	}
	
	/**
	 * @param Domain $domain
	 * @return bool
	 */
	public function has(Domain $domain): bool
	{
		/** @var Domain $tmpDomain */
		foreach ($this->getArrayCopy() as $tmpDomain)
		{
			if (true === $tmpDomain->equals($domain))
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
		
		/** @var Domain $domain */
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