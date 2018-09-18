<?php

namespace RGA\Application\Service\Behaviour;

use RGA\Application\Service\DataProviderInterface;

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