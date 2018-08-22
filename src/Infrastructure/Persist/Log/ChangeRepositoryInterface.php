<?php

namespace RGA\Infrastructure\Persist\Log;

use RGA\Domain\Model\Log\Change;

interface ChangeRepositoryInterface
{
	/**
	 * @param Change $model
	 */
	public function save(Change $model): void;
}