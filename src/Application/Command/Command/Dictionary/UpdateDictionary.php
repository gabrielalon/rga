<?php

namespace RGA\Application\Command\Command\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject\Translate\DataLocale;
use RGA\Infrastructure\Command\Command\CommandInterface;

class UpdateDictionary implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var boolean */
	private $delete;
	
	/** @var array */
	private $entries;
	
	/**
	 * @param string $uuid
	 * @param bool $delete
	 * @param array $entries
	 */
	public function __construct(string $uuid, bool $delete, $entries = [])
	{
		$this->uuid = $uuid;
		$this->delete = $delete;
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
	 * @return array
	 */
	public function getEntries(): array
	{
		return $this->entries;
	}
}