<?php

namespace RGA\Infrastructure\Source\Registry;

use RGA\Infrastructure\Source\Service\ServiceInterface;

interface RegistryInterface
{
	/**
	 * @param string $objectType
	 * @return ServiceInterface
	 * @throws \InvalidArgumentException
	 */
	public function get($objectType): ServiceInterface;
	
	/**
	 * @param ServiceInterface $service
	 */
	public function put(ServiceInterface $service);
	
	/**
	 * @return ServiceInterface[]
	 */
	public function all(): array;
}