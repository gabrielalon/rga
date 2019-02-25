<?php

namespace RGA\Application\Source\Query;

interface RgaObjectQueryInterface
{
	/**
	 * @param GetOne $query
	 */
	public function getOne(GetOne $query): void;
}