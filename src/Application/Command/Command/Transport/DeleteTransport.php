<?php

namespace RGA\Application\Command\Command\Transport;

use RGA\Infrastructure\Command\Command\CommandInterface;

class DeleteTransport
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/**
	 * @param string $uuid
	 */
	public function __construct(string $uuid)
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
}