<?php

namespace RGA\Domain\Validation;

use function preg_match;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\State\State;

class AssertionConcern
{
	/**
	 * @param array $data
	 * @param string $message
	 * @throws \InvalidArgumentException
	 */
	public static function assertArgumentIsLocalesValid($data = [], $message)
	{
		if (true === is_array($data))
		{
			foreach ($data as $languageCode)
			{
				if (1 !== preg_match('#^[a-z]{2}$#i', $languageCode))
				{
					throw new \InvalidArgumentException($message);
				}
			}
		}
	}
	
	/**
	 * @param State $state
	 * @param $message
	 * @throws \InvalidArgumentException
	 */
	public static function assertArgumentIsDeletableState(State $state, $message)
	{
		if (false === $state->isDeletable())
		{
			throw new \InvalidArgumentException($message);
		}
	}

	/**
	 * @param Dictionary $dictionary
	 * @param $message
	 * @throws \InvalidArgumentException
	 */
	public static function assertArgumentIsDeletableDictionary(Dictionary $dictionary, $message)
	{
		if (false === $dictionary->isDeletable())
		{
			throw new \InvalidArgumentException($message);
		}
	}
}