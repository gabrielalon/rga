<?php

namespace RGA\Application\Command\Command\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateDictionary implements CommandInterface
{
	/** @var UuidInterface */
	private $uuid;

	/** @var boolean */
	private $delete;

	/** @var string */
	private $type;

	/** @var Lang */
	private $entries;

	/**
	 * CreateDictionary constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param $delete
	 * @param $type
	 * @param Lang $entries
	 */
	public function __construct(UuidInterface $uuid, bool $delete, string $type, Lang $entries)
	{
		$this->uuid = $uuid;
		$this->delete = $delete;
		$this->type = $type;
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
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return Lang
	 */
	public function getEntries(): Lang
	{
		return $this->entries;
	}
}