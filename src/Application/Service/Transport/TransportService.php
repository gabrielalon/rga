<?php

namespace RGA\Application\Service\Transport;

use RGA\Application\Service;
use RGA\Domain\Model\Transport\Command;

class TransportService
	extends Service\AbstractService
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