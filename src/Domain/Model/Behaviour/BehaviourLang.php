<?php

namespace RGA\Domain\Model\Behaviour;

use RGA\Infrastructure\Model\Translate\TranslateInterface;
use RGA\Infrastructure\Model\Translate\Translated;

class BehaviourLang
	implements TranslateInterface
{
	use Translated;
	
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
	 * @param string $name
	 */
	public function setName($name): void
	{
		$this->name = $name;
	}
}