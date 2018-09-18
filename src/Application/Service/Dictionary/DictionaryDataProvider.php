<?php

namespace RGA\Application\Service\Dictionary;

use RGA\Application\Service\DataProviderInterface;

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
}