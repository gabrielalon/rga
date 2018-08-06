<?php

namespace RGA\Test\Infrastructure\Persist;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Infrastructure\Persist\State\StateRepositoryInterface;

class InMemoryStateRepository implements StateRepositoryInterface
{
	/** @var State[] */
	private $states = [];

	/**
	 * @inheritdoc
	 */
	public function save(State $state): void
	{
		$this->states[(string)$state->getId()] = $state;
	}

	/**
	 * @param string $guid
	 * @return State
	 * @throws NotFound
	 */
	public function load(string $guid): State
	{
		if (isset($this->states[$guid]))
		{
			return clone $this->states[$guid];
		}

		throw new NotFound('State', $guid);
	}

	/**
	 * @param string $id
	 * @return State
	 */
	public function find($id): State
	{
		if (isset($this->states[$id]))
		{
			return clone $this->states[$id];
		}

		throw new NotFound('State', $id);
	}

	/**
	 * @param string $id
	 */
	public function delete($id): void
	{
		unset($this->states[$id]);
	}
}

