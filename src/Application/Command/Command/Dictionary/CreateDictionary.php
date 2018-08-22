<?php

namespace RGA\Application\Command\Command\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject\Translate\DataLocale;
use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateDictionary implements CommandInterface
{
	/** @var string */
	private $uuid;

	/** @var boolean */
	private $delete;

	/** @var string */
	private $type;

	/** @var array */
	private $entries;
	
	/**
	 * @param string $uuid
	 * @param bool $delete
	 * @param string $type
	 * @param array $entries
	 */
	public function __construct(string $uuid, bool $delete, string $type, $entries = [])
	{
		$this->uuid = $uuid;
		$this->delete = $delete;
		$this->type = $type;
		$this->entries = $entries;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
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
	 * @return array
	 */
	public function getEntries(): array
	{
		return $this->entries;
	}
}