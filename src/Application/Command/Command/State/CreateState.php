<?php

namespace RGA\Application\Command\Command\State;

use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateState
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var array */
	private $names;
	
	/** @var array */
	private $emailSubjects;
	
	/** @var array */
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
	 * @param string $uuid
	 * @param array $names
	 * @param array $emailSubjects
	 * @param array $emailBodies
	 * @param bool $isEditable
	 * @param bool $isDeletable
	 * @param bool $isRejectable
	 * @param bool $isFinishable
	 * @param bool $isCloseable
	 * @param bool $isSendingEmail
	 * @param string $colorCode
	 */
	public function __construct(
		string $uuid,
		array $names,
		array $emailSubjects,
		array $emailBodies,
		bool $isEditable,
		bool $isDeletable,
		bool $isRejectable,
		bool $isFinishable,
		bool $isCloseable,
		bool $isSendingEmail,
		string $colorCode
	) {
		$this->uuid = $uuid;
		$this->names = $names;
		$this->emailSubjects = $emailSubjects;
		$this->emailBodies = $emailBodies;
		$this->isEditable = $isEditable;
		$this->isDeletable = $isDeletable;
		$this->isRejectable = $isRejectable;
		$this->isFinishable = $isFinishable;
		$this->isCloseable = $isCloseable;
		$this->isSendingEmail = $isSendingEmail;
		$this->colorCode = $colorCode;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @return array
	 */
	public function getNames(): array
	{
		return $this->names;
	}
	
	/**
	 * @return array
	 */
	public function getEmailSubjects(): array
	{
		return $this->emailSubjects;
	}
	
	/**
	 * @return array
	 */
	public function getEmailBodies(): array
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
	 * @return bool
	 */
	public function isDeletable(): bool
	{
		return $this->isDeletable;
	}
	
	/**
	 * @return bool
	 */
	public function isRejectable(): bool
	{
		return $this->isRejectable;
	}
	
	/**
	 * @return bool
	 */
	public function isFinishable(): bool
	{
		return $this->isFinishable;
	}
	
	/**
	 * @return bool
	 */
	public function isCloseable(): bool
	{
		return $this->isCloseable;
	}
	
	/**
	 * @return bool
	 */
	public function isSendingEmail(): bool
	{
		return $this->isSendingEmail;
	}
	
	/**
	 * @return string
	 */
	public function getColorCode(): string
	{
		return $this->colorCode;
	}
}