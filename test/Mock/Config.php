<?php

namespace RGA\Test\Mock;

use RGA\Infrastructure\Source\Warranty\Config as BaseConfig;

class Config extends BaseConfig
{
	public $daysToReturns;

	public $monthsToComplaint;

	/**
	 * RgaShopConfig constructor.
	 *
	 * @param $daysToReturns
	 * @param $monthsToComplaint
	 */
	public function __construct($daysToReturns, $monthsToComplaint)
	{
		$this->daysToReturns = $daysToReturns;
		$this->monthsToComplaint = $monthsToComplaint;
	}

	/**
	 * @return mixed
	 */
	public function getDaysToReturns(): int
	{
		return $this->daysToReturns;
	}

	/**
	 * @return mixed
	 */
	public function getMonthsToComplaint(): int
	{
		return $this->monthsToComplaint;
	}
}
