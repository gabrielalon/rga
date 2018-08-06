<?php

namespace RGA\Domain\Validation;

use InvalidArgumentException;
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
}