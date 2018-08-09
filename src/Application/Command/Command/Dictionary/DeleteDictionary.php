<?php

namespace RGA\Application\Command\Command\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Infrastructure\Command\Command\CommandInterface;

class DeleteDictionary implements CommandInterface
{
	/** @var UuidInterface */
	private $uuid;

	/**
	 * DeleteDictionary constructor.
	 *
	 * @param UuidInterface $uuid
	 */
	public function __construct(UuidInterface $uuid)
	{
		$this->uuid = $uuid;
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface
	{
		return $this->uuid;
	}

}