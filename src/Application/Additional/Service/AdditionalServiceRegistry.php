<?php

namespace RGA\Application\Additional\Service;

class AdditionalServiceRegistry
{
	/** @var AdditionalServiceInterface[] */
	private $services;
	
	/**
	 * @param AdditionalServiceInterface $service
	 */
	public function put(AdditionalServiceInterface $service): void
	{
		$this->services[$service->getType()] = $service;
	}
	
	/**
	 * @param string $type
	 * @return AdditionalServiceInterface
	 */
	public function get(string $type): AdditionalServiceInterface
	{
		if (false === isset($this->services[$type]))
		{
			return new EmptyAdditionalService();
		}
		
		return $this->services[$type];
	}
	
	/**
	 * @return AdditionalServiceInterface[]
	 */
	public function services(): array
	{
		return $this->services;
	}
}