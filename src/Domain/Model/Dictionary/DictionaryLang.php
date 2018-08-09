<?php

namespace RGA\Domain\Model\Dictionary;

use RGA\Infrastructure\Model\Translate\Translated;
use RGA\Infrastructure\Model\Translate\TranslateInterface;

class DictionaryLang implements TranslateInterface
{
	use Translated;

	/** @var string */
	private $entry;

	/**
	 * @return string
	 */
	public function getEntry(): string
	{
		return $this->entry;
	}

	/**
	 * @param string $entry
	 */
	public function setEntry($entry): void
	{
		$this->entry = $entry;
	}
}