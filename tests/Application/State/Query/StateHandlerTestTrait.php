<?php


namespace RGA\Test\Application\State\Query;

use RGA\Application\State\Query\ReadModel\State;

trait StateHandlerTestTrait
{
	/**
	 * @param string $uuid
	 * @param string $name
	 * @return State
	 */
	protected function createStateView(string $uuid, string $name): State
	{
		return State::fromUuid($uuid)
			->addName('pl', $name)
		;
	}
}