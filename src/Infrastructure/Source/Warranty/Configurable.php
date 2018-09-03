<?php

namespace RGA\Infrastructure\Source\Warranty;

interface Configurable
{
	/**
	 * @return int
	 */
	public function getDaysToReturns(): int;
	
	/**
	 * @return int
	 */
	public function getMonthsToComplaint(): int;
}