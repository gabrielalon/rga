<?php

namespace RGA\Test\Infrastructure\Persist;

use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepositoryInterface;

class InMemoryBehaviourRepository implements BehaviourRepositoryInterface
{
	/** @var Behaviour[] */
	private $behaviours = [];

	/**
	 * @inheritdoc
	 */
	public function save(Behaviour $behaviour): void
	{
		$this->behaviours[(string)$behaviour->getId()] = $behaviour;
	}

	/**
	 * @param string $guid
	 * @return Behaviour
	 * @throws NotFound
	 */
	public function load(string $guid): Behaviour
	{
		if (isset($this->behaviours[$guid]))
		{
			return clone $this->behaviours[$guid];
		}

		throw new NotFound('Behaviour', $guid);
	}

	/**
	 * @param string $id
	 * @return Behaviour
	 */
	public function find($id): Behaviour
	{
		// TODO: Implement find() method.
	}
}

