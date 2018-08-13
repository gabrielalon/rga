<?php

namespace RGA\Application\Source\Warranty;

use RGA\Infrastructure\Source\Warranty\ConfigInterface;

class Calculator
{
	/** @var ConfigInterface */
	private $config;
	
	/**
	 * @param ConfigInterface $config
	 */
	public function __construct(ConfigInterface $config)
	{
		$this->setConfig($config);
	}
	
	/**
	 * @param ConfigInterface $config
	 */
	public function setConfig($config): void
	{
		$this->config = $config;
	}
	
	/**
	 * @param int $creationDate
	 * @return false|int
	 */
	public function getFinalDateOfReturn($creationDate)
	{
		return strtotime('+' . $this->config->getDaysToReturns() . 'day', $creationDate);
	}

	/**
	 * @param int $creationDate
	 * @param int|null $warranty
	 * @return false|int
	 */
	public function getFinalDateOfComplaint(int $creationDate, ?int $warranty = null)
	{
		if (null !== $warranty && $this->config->getMonthsToComplaint() < $warranty)
		{
			return strtotime('+' . $warranty . 'month', $creationDate);
		}
		
		return strtotime('+' . $this->config->getMonthsToComplaint() . 'month', $creationDate);
	}
}