<?php

namespace RGA\Application\Dictionary\Service;

use RGA\Application\Dictionary\Command;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractCommandManager;

class DictionaryCommandManager
	extends AbstractCommandManager
{
	/**
	 * @param DictionaryDataProvider $provider
	 */
	public function create(DictionaryDataProvider $provider): void
	{
		$command = new Command\CreateDictionary(
			$provider->uuid(),
			$provider->type(),
			$provider->entries(),
			$provider->behaviours()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param DictionaryDataProvider $provider
	 */
	public function change(DictionaryDataProvider $provider): void
	{
		$command = new Command\ChangeDictionary(
			$provider->uuid(),
			$provider->entries(),
			$provider->behaviours()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param string $uuid
	 */
	public function remove(string $uuid): void
	{
		$command = new Command\RemoveDictionary($uuid);
		
		$this->handle($command);
	}
}