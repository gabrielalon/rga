<?php

namespace RGA\Test\Infrastructure\Persist;

use RGA\Domain\Model\Log\Change;
use RGA\Infrastructure\Persist\Log\ChangeRepositoryInterface;

class InMemoryChangeRepository
	implements ChangeRepositoryInterface
{
	/** @var Change[] */
	private $logs = [];
	
	/**
	 * @param Change $model
	 */
	public function save(Change $model): void
	{
		$this->logs[] = $model;
	}
}