<?php

namespace RGA\Domain\Model\Behaviour;

use RGA\Infrastructure\Model\Identify\GuidInterface;
use RGA\Infrastructure\Model\Identify\Guided;
use RGA\Infrastructure\Model\Translate\Lang\CollectionInterface;
use RGA\Infrastructure\Model\Translate\Lang\Collected;

class Behaviour
	implements GuidInterface, CollectionInterface
{
	use Guided;
	use Collected;
	
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
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @param bool $isActive
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;
	}
}