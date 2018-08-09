<?php

namespace RGA\Domain\Validation;

use InvalidArgumentException;
use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Domain\Model\State\State;

class AssertionConcern
{
	/**
	 * @param State $state
	 * @param $message
	 */
	public static function assertArgumentIsDeletableState(State $state, $message)
	{
		if (false === $state->isDeletable())
		{
			throw new InvalidArgumentException($message);
		}
	}

	/**
	 * @param Dictionary $dictionary
	 * @param $message
	 */
	public static function assertArgumentIsDeletableDictionary(Dictionary $dictionary, $message)
	{
		if (false === $dictionary->isDeletable())
		{
			throw new InvalidArgumentException($message);
		}
	}
}