<?php

namespace RGA\Application\Transport\Service;

use RGA\Application\Transport\Command;
use RGA\Infrastructure\SegregationSourcing\Service\AbstractCommandManager;

class TransportCommandManager
	extends AbstractCommandManager
{
	/**
	 * @param TransportDataProvider $provider
	 */
	public function create(TransportDataProvider $provider): void
	{
		$command = new Command\CreateTransport(
			$provider->uuid(),
			$provider->activation(),
			$provider->shipmentId(),
			$provider->domains(),
			$provider->names()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param TransportDataProvider $provider
	 */
	public function change(TransportDataProvider $provider): void
	{
		$command = new Command\ChangeTransport(
			$provider->uuid(),
			$provider->activation(),
			$provider->shipmentId(),
			$provider->domains(),
			$provider->names()
		);
		
		$this->handle($command);
	}
	
	/**
	 * @param string $uuid
	 */
	public function remove(string $uuid): void
	{
		$command = new Command\RemoveTransport($uuid);
		
		$this->handle($command);
	}
}