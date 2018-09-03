<?php

namespace RGA\Test\Mock\Warranty\ConfigStorage;

use RGA\Infrastructure\Source\Warranty\ConfigStorage\ConfigStorageInterface;

class ArgumentConfiguration
	implements ConfigStorageInterface
{
	/** @var integer */
	public $daysToReturns;
	
	/** @var integer */
	public $monthsToComplaint;
	
	/**
	 * @param int $daysToReturns
	 * @param int $monthsToComplaint
	 */
	public function __construct(int $daysToReturns, int $monthsToComplaint)
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