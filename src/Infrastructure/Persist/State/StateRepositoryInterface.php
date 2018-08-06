<?php

namespace RGA\Infrastructure\Persist\State;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\Persist\Exception\NotFound;

interface StateRepositoryInterface
{
	/**
	 * @param string $id
	 * @return State
	 */
	public function find($id): State;

	/**
	 * @param State $model
	 */
	public function save(State $model);

	/**
	 * @param string $guid
	 * @return State
	 * @throws NotFound
	 */
	public function load(string $guid): State;

	/**
	 * @param string $id
	 */
	public function delete($id);
}