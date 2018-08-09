<?php

namespace RGA\Domain\Model\Dictionary;

use Ramsey\Uuid\UuidInterface;
use RGA\Infrastructure\Model\Translate\Lang\Collected;
use RGA\Infrastructure\Model\Translate\Lang\CollectionInterface;

class Dictionary implements CollectionInterface
{
	use Collected;

	/** @var UuidInterface */
	private $uuid;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var boolean
	 */
	private $isDeletable;

	/**
	 * @var DictionaryLang[]
	 */
	private $dictionaryLangs;

	/**
	 * Dictionary constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param string $type
	 * @param bool $isDeletable
	 */
	public function __construct(UuidInterface $uuid, string $type, bool $isDeletable)
	{
		$this->uuid = $uuid;
		$this->type = $type;
		$this->isDeletable = $isDeletable;
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
	public function isDeletable(): bool
	{
		return $this->isDeletable;
	}

	/**
	 * @param bool $isDeletable
	 */
	public function setIsDeletable(bool $isDeletable): void
	{
		$this->isDeletable = $isDeletable;
	}

}