<?php

namespace RGA\Domain\Model\Behaviour;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class BehaviourLocale
	implements Translate\Translatable
{
	use Translate\Translated;
	
	/** @var string */
	private $name;
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @param ValueObject\Behaviour\Name $name
	 */
	public function setName(ValueObject\Behaviour\Name $name): void
	{
		$this->name = $name->getValue();
	}
}