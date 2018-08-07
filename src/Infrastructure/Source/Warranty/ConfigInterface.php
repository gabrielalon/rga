<?php

namespace RGA\Infrastructure\Source\Warranty;

interface ConfigInterface
{
	/**
	 * @return int
	 */
	public function getDaysToReturns();

	/**
	 * @return int
	 */
	public function getMonthsToComplaint();
}