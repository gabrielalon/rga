<?php

namespace RGA\Domain\Model\Rga\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeFlagsRga
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var boolean */
	private $isProductReceived;
	
	/** @var boolean */
	private $isCashReturned;
	
	/** @var boolean */
	private $isProductReturned;
	
	/** @var string */
	private $notesForApplicant;
	
	/**
	 * @param string $uuid
	 * @param bool $isProductReceived
	 * @param bool $isCashReturned
	 * @param bool $isProductReturned
	 * @param string $notesForApplicant
	 */
	public function __construct(
		string $uuid,
		bool $isProductReceived,
		bool $isCashReturned,
		bool $isProductReturned,
		string $notesForApplicant
	)
	{
		$this->setUuid($uuid);
		$this->isProductReceived = $isProductReceived;
		$this->isCashReturned = $isCashReturned;
		$this->isProductReturned = $isProductReturned;
		$this->notesForApplicant = $notesForApplicant;
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
}