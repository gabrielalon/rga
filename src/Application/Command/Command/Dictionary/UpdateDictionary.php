<?php

namespace RGA\Application\Command\Command\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Command\Command\CommandInterface;

class UpdateDictionary implements CommandInterface
{
	/** @var UuidInterface */
	private $uuid;

	/** @var boolean */
	private $delete;

	/** @var Lang */
	private $entries;

	/**
	 * UpdateDictionary constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param bool $delete
	 * @param Lang $entries
	 */
	public function __construct(UuidInterface $uuid, bool $delete, Lang $entries)
	{
		$this->uuid = $uuid;
		$this->delete = $delete;
		$this->entries = $entries;
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface
	{
		return $this->uuid;
	}

	/**
	 * @return bool
	 */
	public function isDelete(): bool
	{
		return $this->delete;
	}

	/**
	 * @return Lang
	 */
	public function getEntries(): Lang
	{
		return $this->entries;
	}
}