<?php

namespace RGA\Domain\Model\Behaviour;

use Ramsey\Uuid\UuidInterface;
use RGA\Infrastructure\Model\Translate\Lang\Collected;
use RGA\Infrastructure\Model\Translate\Lang\CollectionInterface;

class Behaviour implements CollectionInterface
{
	use Collected;

	/** @var UuidInterface */
	private $uuid;

	/** @var string */
	private $type;

	/** @var boolean */
	private $isActive;

	/**
	 * Behaviour constructor.
	 *
	 * @param UuidInterface $uuid
	 */
	public function __construct(UuidInterface $uuid)
	{
		$this->uuid = $uuid;
	}

	/**
	 * @param string $type
	 */
	public function setType(string $type): void
	{
		$this->type = $type;
	}

	/**
	 * @param bool $isActive
	 */
	public function setIsActive(bool $isActive): void
	{
		$this->isActive = $isActive;
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface
	{
		return $this->uuid;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

}