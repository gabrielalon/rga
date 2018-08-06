<?php

namespace RGA\Application\Command\Command\State;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateState implements CommandInterface
{
	/** @var UuidInterface */
	private $uuid;

	/** @var Lang */
	private $names;

	/** @var Lang */
	private $emailSubjects;

	/** @var Lang */
	private $emailBodies;

	/** @var boolean */
	private $isEditable;

	/** @var boolean */
	private $isDeletable;

	/** @var boolean */
	private $isRejectable;

	/** @var boolean */
	private $isFinishable;

	/** @var boolean */
	private $isCloseable;

	/** @var boolean */
	private $isSendingEmail;

	/** @var string */
	private $colorCode;

	/**
	 * CreateState constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param Lang $names
	 * @param Lang $emailSubjects
	 * @param Lang $emailBodies
	 * @param string $colorCode
	 */
	public function __construct(UuidInterface $uuid, Lang $names, Lang $emailSubjects, Lang $emailBodies, string $colorCode)
	{
		$this->uuid = $uuid;
		$this->names = $names;
		$this->emailSubjects = $emailSubjects;
		$this->emailBodies = $emailBodies;
		$this->colorCode = $colorCode;
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface
	{
		return $this->uuid;
	}

	/**
	 * @return Lang
	 */
	public function getNames(): Lang
	{
		return $this->names;
	}

	/**
	 * @return Lang
	 */
	public function getEmailSubjects(): Lang
	{
		return $this->emailSubjects;
	}

	/**
	 * @return Lang
	 */
	public function getEmailBodies(): Lang
	{
		return $this->emailBodies;
	}

	/**
	 * @return bool
	 */
	public function isEditable(): bool
	{
		return $this->isEditable;
	}

	/**
	 * @param bool $isEditable
	 */
	public function setIsEditable($isEditable): void
	{
		$this->isEditable = $isEditable;
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
	public function setIsDeletable($isDeletable): void
	{
		$this->isDeletable = $isDeletable;
	}

	/**
	 * @return bool
	 */
	public function isRejectable(): bool
	{
		return $this->isRejectable;
	}

	/**
	 * @param bool $isRejectable
	 */
	public function setIsRejectable($isRejectable): void
	{
		$this->isRejectable = $isRejectable;
	}

	/**
	 * @return bool
	 */
	public function isFinishable(): bool
	{
		return $this->isFinishable;
	}

	/**
	 * @param bool $isFinishable
	 */
	public function setIsFinishable($isFinishable): void
	{
		$this->isFinishable = $isFinishable;
	}

	/**
	 * @return bool
	 */
	public function isCloseable(): bool
	{
		return $this->isCloseable;
	}

	/**
	 * @param bool $isCloseable
	 */
	public function setIsCloseable($isCloseable): void
	{
		$this->isCloseable = $isCloseable;
	}

	/**
	 * @return bool
	 */
	public function isSendingEmail(): bool
	{
		return $this->isSendingEmail;
	}

	/**
	 * @param bool $isSendingEmail
	 */
	public function setIsSendingEmail(bool $isSendingEmail): void
	{
		$this->isSendingEmail = $isSendingEmail;
	}

	/**
	 * @return string
	 */
	public function getColorCode(): string
	{
		return $this->colorCode;
	}
}