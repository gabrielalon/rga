<?php

namespace RGA\Domain\Model\Rga\Rga\Given;

class Additional
{
	/** @var string */
	private $serviceType;
	
	/** @var array */
	private $serviceData;
	
	/**
	 * @param string $serviceType
	 * @param array $serviceData
	 */
	public function __construct(string $serviceType, array $serviceData)
	{
		$this->serviceType = $serviceType;
		$this->serviceData = $serviceData;
	}
	
	/**
	 * @return string
	 */
	public function getServiceType(): string
	{
		return $this->serviceType;
	}
	
	/**
	 * @return array
	 */
	public function getServiceData(): array
	{
		return $this->serviceData;
	}
}