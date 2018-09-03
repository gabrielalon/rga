<?php

namespace RGA\Infrastructure\Source\Warranty\ConfigStorage;

class VendorConfigurationFile
	implements ConfigStorageInterface
{
	/** @var integer */
	private $daysToReturns;
	
	/** @var integer */
	private $monthsToComplaint;
	
	public function __construct()
	{
		$this->loadData();
	}
	
	private function loadData(): void
	{
		$file = __DIR__ . '/../../../../../config/warranty.php';
		if (true === file_exists($file))
		{
			$warranty = include($file);
			if (true === \is_array($warranty))
			{
				$this->daysToReturns = $warranty['days_to_returns'];
				$this->monthsToComplaint = $warranty['months_to_complaints'];
				
				return;
			}
		}
		
		throw new \RuntimeException('Warranty not configured');
	}
	
	/**
	 * @return int
	 */
	public function getDaysToReturns(): int
	{
		return $this->daysToReturns;
	}
	
	/**
	 * @return int
	 */
	public function getMonthsToComplaint(): int
	{
		return $this->monthsToComplaint;
	}
}