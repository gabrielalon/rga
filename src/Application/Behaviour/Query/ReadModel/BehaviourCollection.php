<?php

namespace RGA\Application\Behaviour\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class BehaviourCollection
	extends \ArrayIterator
		implements ViewableCollection
{
	/**
	 * @param Behaviour $behaviour
	 */
	public function add(Behaviour $behaviour): void
	{
		$this->offsetSet($behaviour->identifier(), $behaviour);
	}
	
	/**
	 * @param string $uuid
	 * @return Behaviour
	 */
	public function get(string $uuid): Behaviour
	{
		return $this->offsetGet($uuid);
	}
	
	/**
	 * @param string $uuid
	 * @return bool
	 */
	public function has(string $uuid): bool
	{
		return $this->offsetExists($uuid);
	}
	
	/**
	 * @return Behaviour[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}