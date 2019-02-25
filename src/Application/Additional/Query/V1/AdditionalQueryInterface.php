<?php

namespace RGA\Application\Additional\Query\V1;

interface AdditionalQueryInterface
{
	/**
	 * @param FindAllByRgaUuid $query
	 */
	public function findAllByRgaUuid(FindAllByRgaUuid $query): void;
}