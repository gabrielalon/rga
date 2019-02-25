<?php

namespace RGA\Application\State\Service;

use RGA\Application\State\Command;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractCommandManager;

class StateCommandManager
	extends AbstractCommandManager
{
	/**
	 * @param StateDataProvider $provider
	 */
	public function create(StateDataProvider $provider): void
	{
		$command = new Command\CreateState(
			$provider->uuid(),
			$provider->editable(),
			$provider->deletable(),
			$provider->rejectable(),
			$provider->finishable(),
			$provider->closeable(),
			$provider->sendsEmail(),
			$provider->colorCode(),
			$provider->names(),
			$provider->emailSubjects(),
			$provider->emailBody()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param StateDataProvider $provider
	 */
	public function change(StateDataProvider $provider): void
	{
		$command = new Command\ChangeState(
			$provider->uuid(),
			$provider->editable(),
			$provider->deletable(),
			$provider->rejectable(),
			$provider->finishable(),
			$provider->closeable(),
			$provider->sendsEmail(),
			$provider->colorCode(),
			$provider->names(),
			$provider->emailSubjects(),
			$provider->emailBody()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param string $uuid
	 */
	public function remove(string $uuid): void
	{
		$command = new Command\RemoveState($uuid);
		
		$this->handle($command);
	}
}