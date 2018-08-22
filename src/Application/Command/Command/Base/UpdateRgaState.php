<?php

namespace RGA\Application\Command\Command\Base;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Command\Command\CommandInterface;

class UpdateRgaState
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var string */
	private $stateUuid;
	
	/** @var boolean */
	private $isProductReceived;
	
	/** @var boolean */
	private $isCashReturned;
	
	/** @var boolean */
	private $isProductReturned;
	
	/** @var string */
	private $notesForApplicant;
	
	/** @var ValueObject\Base\BlamableAdmin */
	private $admin;
	
	/**
	 * @param string $uuid
	 * @param string $stateUuid
	 * @param bool $isProductReceived
	 * @param bool $isCashReturned
	 * @param bool $isProductReturned
	 * @param string $notesForApplicant
	 * @param ValueObject\Base\BlamableAdmin $admin
	 */
	public function __construct(
		string $uuid,
		string $stateUuid,
		bool $isProductReceived,
		bool $isCashReturned,
		bool $isProductReturned,
		string $notesForApplicant,
		ValueObject\Base\BlamableAdmin $admin
	)
	{
		$this->uuid = $uuid;
		$this->stateUuid = $stateUuid;
		$this->isProductReceived = $isProductReceived;
		$this->isCashReturned = $isCashReturned;
		$this->isProductReturned = $isProductReturned;
		$this->notesForApplicant = $notesForApplicant;
		$this->admin = $admin;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @return string
	 */
	public function getStateUuid(): string
	{
		return $this->stateUuid;
	}
	
	/**
	 * @return bool
	 */
	public function isProductReceived(): bool
	{
		return $this->isProductReceived;
	}
	
	/**
	 * @return bool
	 */
	public function isCashReturned(): bool
	{
		return $this->isCashReturned;
	}
	
	/**
	 * @return bool
	 */
	public function isProductReturned(): bool
	{
		return $this->isProductReturned;
	}
	
	/**
	 * @return string
	 */
	public function getNotesForApplicant(): string
	{
		return $this->notesForApplicant;
	}
	
	/**
	 * @return ValueObject\Base\BlamableAdmin
	 */
	public function getAdmin(): ValueObject\Base\BlamableAdmin
	{
		return $this->admin;
	}
}