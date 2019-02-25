<?php

namespace RGA\Application\Dictionary\Service;

use RGA\Infrastructure\SegregationSourcing\Service\DataProviderInterface;

interface DictionaryDataProvider
	extends DataProviderInterface
{
	/**
	 * @return array
	 */
	public function entries(): array;
	
	/**
	 * @return string
	 */
	public function type(): string;
	
	/**
	 * @return string[]
	 */
	public function behaviours(): array;
}