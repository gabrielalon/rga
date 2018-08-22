<?php

namespace RGA\Domain\Model\State;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Identify;
use RGA\Infrastructure\Model\Translate;

class State
	implements Identify\Guidable, Translate\Localable
{
	use Identify\Guided;
	use Translate\Localed;

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
	
	/**
	 * @return bool
	 */
	public function isEditable(): bool
	{
		return $this->isEditable;
	}
	
	/**
	 * @param ValueObject\State\IsEditable $isEditable
	 */
	public function setIsEditable(ValueObject\State\IsEditable $isEditable): void
	{
		$this->isEditable = $isEditable->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isDeletable(): bool
	{
		return $this->isDeletable;
	}
	
	/**
	 * @param ValueObject\State\IsDeletable $isDeletable
	 */
	public function setIsDeletable(ValueObject\State\IsDeletable $isDeletable): void
	{
		$this->isDeletable = $isDeletable->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isRejectable(): bool
	{
		return $this->isRejectable;
	}
	
	/**
	 * @param ValueObject\State\IsRejectable $isRejectable
	 */
	public function setIsRejectable(ValueObject\State\IsRejectable $isRejectable): void
	{
		$this->isRejectable = $isRejectable->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isFinishable(): bool
	{
		return $this->isFinishable;
	}
	
	/**
	 * @param ValueObject\State\IsFinishable $isFinishable
	 */
	public function setIsFinishable(ValueObject\State\IsFinishable $isFinishable): void
	{
		$this->isFinishable = $isFinishable->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isCloseable(): bool
	{
		return $this->isCloseable;
	}
	
	/**
	 * @param ValueObject\State\IsCloseable $isCloseable
	 */
	public function setIsCloseable(ValueObject\State\IsCloseable $isCloseable): void
	{
		$this->isCloseable = $isCloseable->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isSendingEmail(): bool
	{
		return $this->isSendingEmail;
	}
	
	/**
	 * @param ValueObject\State\IsSendingEmail $isSendingEmail
	 */
	public function setIsSendingEmail(ValueObject\State\IsSendingEmail $isSendingEmail): void
	{
		$this->isSendingEmail = $isSendingEmail->getValue();
	}
	
	/**
	 * @return string
	 */
	public function getColorCode(): string
	{
		return $this->colorCode;
	}
	
	/**
	 * @param ValueObject\State\ColorCode $colorCode
	 */
	public function setColorCode(ValueObject\State\ColorCode $colorCode): void
	{
		$this->colorCode = $colorCode->getValue();
	}
}