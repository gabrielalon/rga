<?php

namespace RGA\Infrastructure\Persist\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour;

interface BehaviourRepositoryInterface
{
	/**
	 * @param string $id
	 * @return Behaviour
	 */
	public function find($id);
	
	/**
	 * @param Behaviour $model
	 */
	public function save(Behaviour $model);
}