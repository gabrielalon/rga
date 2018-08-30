<?php

namespace RGA\Test\Mock\Warranty;

use RGA\Infrastructure\Source\Warranty\ConfigInterface;

class Config
	implements ConfigInterface
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
