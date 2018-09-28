<?php

namespace RGA\Application\Service\Dictionary;

use RGA\Application\Service;
use RGA\Domain\Model\Dictionary\Command;

class DictionaryService
	extends Service\AbstractService
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