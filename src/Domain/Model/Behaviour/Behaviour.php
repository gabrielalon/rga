<?php

namespace RGA\Domain\Model\Behaviour;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Identify;
use RGA\Infrastructure\Model\Translate;

class Behaviour
	implements Identify\Guidable, Translate\Localable
{
	use Identify\Guided;
	use Translate\Localed;

	/** @var string */
	private $type;

	/** @var boolean */
	private $isActive;
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
	
	/**
	 * @param ValueObject\Behaviour\Type $type
	 */
	public function setType(ValueObject\Behaviour\Type $type): void
	{
		$this->type = $type->getValue();
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @param ValueObject\Behaviour\IsActive $isActive
	 */
	public function setIsActive(ValueObject\Behaviour\IsActive $isActive): void
	{
		$this->isActive = $isActive->getValue();
	}
}