<?php

namespace RGA\Domain\Model\Transport;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class TransportLocale
	implements Translate\Translatable
{
	use Translate\Translated;
	
	/** @var string */
	protected $name;
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @param ValueObject\Transport\Name $name
	 */
	public function setName(ValueObject\Transport\Name $name): void
	{
		$this->name = $name->getValue();
	}
}