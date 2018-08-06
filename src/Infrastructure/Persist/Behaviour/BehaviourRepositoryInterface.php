<?php

namespace RGA\Infrastructure\Persist\Behaviour;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Infrastructure\Persist\Exception\NotFound;

interface BehaviourRepositoryInterface
{
	/**
	 * @param string $id
	 * @return Behaviour
	 */
	public function find($id): Behaviour;
	
	/**
	 * @param Behaviour $model
	 */
	public function save(Behaviour $model);

	/**
	 * @param string $guid
	 * @return Behaviour
	 * @throws NotFound
	 */
	public function load(string $guid): Behaviour;
}