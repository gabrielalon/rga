<?php

namespace RGA\Application\State\Query\V1;

interface StateQueryInterface
{
	/**
	 * @param FindOneByUuid $query
	 */
	public function findOneByUuid(FindOneByUuid $query): void;
	
	/**
	 * @param FindOneByName $query
	 */
	public function findOneByName(FindOneByName $query): void;
	
	/**
	 * @param FindOneByRgaUuid $query
	 */
	public function findOneByRgaUuid(FindOneByRgaUuid $query): void;
	
	/**
	 * @param FindAll $query
	 */
	public function findAll(FindAll $query): void;
}