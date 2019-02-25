<?php

namespace RGA\Application\Dictionary\Query\V1;

interface DictionaryQueryInterface
{
	/**
	 * @param FindOneByUuid $query
	 */
	public function findOneByUuid(FindOneByUuid $query): void;
	
	/**
	 * @param FindAllByType $query
	 */
	public function findAllByType(FindAllByType $query): void;
	
	/**
	 * @param FindAllByTypeAndBehaviourUuid $query
	 */
	public function findAllByTypeAndBehaviourUuid(FindAllByTypeAndBehaviourUuid $query): void;
	
	/**
	 * @param FindAll $query
	 */
	public function findAll(FindAll $query): void;
}