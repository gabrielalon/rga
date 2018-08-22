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
		$this->behaviours[(string)$behaviour->getUuid()] = $behaviour;
	}

	/**
	 * @param string $id
	 * @return Behaviour
	 */
	public function find($id): Behaviour
	{
		if (isset($this->behaviours[$id]))
		{
			return clone $this->behaviours[$id];
		}
		
		throw new NotFound('Behaviour', $id);
	}
}

