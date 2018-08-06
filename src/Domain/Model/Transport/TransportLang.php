<?php

namespace RGA\Domain\Model\Transport;

use RGA\Infrastructure\Model\Translate;

class TransportLang
	implements Translate\TranslateInterface
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
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}
}