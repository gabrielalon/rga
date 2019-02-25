<?php

namespace RGA\Application\Behaviour\Service;

use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface BehaviourDataProvider
	extends DataProviderInterface
{
	/**
	 * @return array
	 */
	public function names(): array;
	
	/**
	 * @return string
	 */
	public function type(): string;
	
	/**
	 * @return bool
	 */
	public function activation(): bool;
}