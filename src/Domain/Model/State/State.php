<?php

namespace RGA\Domain\Model\State;

use Ramsey\Uuid\UuidInterface;
use RGA\Domain\ValueObject\Lang\Lang;
use RGA\Infrastructure\Model\Identify\Guided;
use RGA\Infrastructure\Model\Identify\GuidInterface;
use RGA\Infrastructure\Model\Translate\Lang\Collected;
use RGA\Infrastructure\Model\Translate\Lang\CollectionInterface;

class State implements GuidInterface, CollectionInterface
{
	use Guided;
	use Collected;

	/** @var bool */
	private $isEditable;

	/** @var bool */
	private $isDeletable;

	/** @var bool */
	private $isRejectable;

	/** @var bool */
	private $isFinishable;

	/** @var bool */
	private $isCloseable;

	/** @var bool */
	private $isSendingEmail;

	/** @var string */
	private $colorCode;

	/** @var Lang */
	private $name;

	/** @var Lang */
	private $emailSubject;

	/** @var Lang */
	private $emailBody;

	/**
	 * State constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param bool $isSendingEmail
	 * @param string $colorCode
	 * @param Lang $name
	 * @param Lang $emailSubject
	 * @param Lang $emailBody
	 */
	public function __construct(UuidInterface $uuid, bool $isSendingEmail, string $colorCode, Lang $name, Lang $emailSubject, Lang $emailBody)
	{
		$this->id = $uuid;
//		$this->isEditable = $isEditable;
//		$this->isDeletable = $isDeletable;
//		$this->isRejectable = $isRejectable;
//		$this->isFinishable = $isFinishable;
//		$this->isCloseable = $isCloseable;
		$this->isSendingEmail = $isSendingEmail;
		$this->colorCode = $colorCode;
		$this->name = $name;
		$this->emailSubject = $emailSubject;
		$this->emailBody = $emailBody;
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
	public function setIsEditable(bool $isEditable): void
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
	public function setIsDeletable(bool $isDeletable): void
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
	public function setIsRejectable(bool $isRejectable): void
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
	public function setIsFinishable(bool $isFinishable): void
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
	public function setIsCloseable(bool $isCloseable): void
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

	/**
	 * @param string $colorCode
	 */
	public function setColorCode(string $colorCode): void
	{
		$this->colorCode = $colorCode;
	}

	/**
	 * @return Lang
	 */
	public function getName(): Lang
	{
		return $this->name;
	}

	/**
	 * @param Lang $name
	 */
	public function setName(Lang $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return Lang
	 */
	public function getEmailSubject(): Lang
	{
		return $this->emailSubject;
	}

	/**
	 * @param Lang $emailSubject
	 */
	public function setEmailSubject(Lang $emailSubject): void
	{
		$this->emailSubject = $emailSubject;
	}

	/**
	 * @return Lang
	 */
	public function getEmailBody(): Lang
	{
		return $this->emailBody;
	}

	/**
	 * @param Lang $emailBody
	 */
	public function setEmailBody(Lang $emailBody): void
	{
		$this->emailBody = $emailBody;
	}

}