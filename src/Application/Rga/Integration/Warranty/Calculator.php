<?php

namespace RGA\Application\Rga\Integration\Warranty;

use RGA\Infrastructure\Source\Warranty\ConfigInterface;

class Calculator
{
	/** @var ConfigInterface */
	private $config;
	
	/** @var integer */
	private $creationDate;
	
	/**
	 * @param ConfigInterface $config
	 */
	public function __construct(ConfigInterface $config)
	{
		$this->config = $config;
		$this->setCreationDate(time());
	}
	
	/**
	 * @param int $creationDate
	 */
	public function setCreationDate(int $creationDate): void
	{
		$this->creationDate = $creationDate;
	}
	
	/**
	 * @return false|int
	 */
	public function getFinalDateOfReturn()
	{
		return strtotime('+' . $this->config->getDaysToReturns() . 'day', $this->creationDate);
	}

	/**
	 * @param int|null $warranty
	 * @return false|int
	 */
	public function getFinalDateOfComplaint(?int $warranty = null)
	{
		if (null !== $warranty && $this->config->getMonthsToComplaint() < $warranty)
		{
			return strtotime('+' . $warranty . 'month', $this->creationDate);
		}
		
		return strtotime('+' . $this->config->getMonthsToComplaint() . 'month', $this->creationDate);
	}
}