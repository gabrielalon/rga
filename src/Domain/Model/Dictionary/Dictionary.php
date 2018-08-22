<?php

namespace RGA\Domain\Model\Dictionary;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Identify;
use RGA\Infrastructure\Model\Translate;

class Dictionary
	implements Identify\Guidable, Translate\Localable
{
	use Identify\Guided;
	use Translate\Localed;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var boolean
	 */
	private $isDeletable;
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
	
	/**
	 * @param ValueObject\Dictionary\Type $type
	 */
	public function setType(ValueObject\Dictionary\Type $type): void
	{
		$this->type = $type->getValue();
	}

	/**
	 * @return bool
	 */
	public function isDeletable(): bool
	{
		return $this->isDeletable;
	}

	/**
	 * @param ValueObject\Dictionary\IsDeletable $isDeletable
	 */
	public function setIsDeletable(ValueObject\Dictionary\IsDeletable $isDeletable): void
	{
		$this->isDeletable = $isDeletable->getValue();
	}
}