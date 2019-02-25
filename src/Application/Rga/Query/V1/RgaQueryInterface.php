<?php

namespace RGA\Application\Rga\Query\V1;

interface RgaQueryInterface
{
	/**
	 * @param FindOneByUuid $query
	 */
	public function findOneByUuid(FindOneByUuid $query): void;
	
	/**
	 * @param FindOneByCode $query
	 */
	public function findOneByCode(FindOneByCode $query): void;
	
	/**
	 * @param FindOneByHash $query
	 */
	public function findOneByHash(FindOneByHash $query): void;
	
	/**
	 * @param FindOneByIndividualNumber $query
	 */
	public function findOneByIndividualNumber(FindOneByIndividualNumber $query): void;
	
	/**
	 * @param FindAll $query
	 */
	public function findAll(FindAll $query): void;
}