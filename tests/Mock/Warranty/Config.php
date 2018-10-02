<?php

namespace RGA\Test\Mock\Warranty;

use RGA\Infrastructure\Source\Warranty\ConfigInterface;
use RGA\Infrastructure\Source\Warranty\ConfigStorage\ConfigStorageInterface;
use RGA\Test\Mock\Warranty\ConfigStorage\ArgumentConfiguration;

class Config
	implements ConfigInterface
{
	/** @var ConfigStorageInterface */
	private $storage;
	
	/**
	 * @param int $daysToReturns
	 * @param int $monthsToComplaint
	 * @return Config
	 */
	public static function fromDates(int $daysToReturns, int $monthsToComplaint): Config
	{
		return new Config(new ArgumentConfiguration($daysToReturns, $monthsToComplaint));
	}
	
	/**
	 * @param ConfigStorageInterface $storage
	 */
	public function __construct(ConfigStorageInterface $storage)
	{
		$this->storage = $storage;
	}
	
	/**
	 * @return int
	 */
	public function getDaysToReturns(): int
	{
		return $this->storage->getDaysToReturns();
	}
	
	/**
	 * @return int
	 */
	public function getMonthsToComplaint(): int
	{
		return $this->storage->getMonthsToComplaint();
	}
	
	/**
	 * @return int
	 */
	public function getWarrantyInMonths(): int
	{
		return $this->storage->getWarrantyInMonths();
	}
}
