<?php

namespace RGA\Infrastructure\Source\Warranty;

interface ConfigInterface
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