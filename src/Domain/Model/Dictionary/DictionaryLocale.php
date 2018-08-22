<?php

namespace RGA\Domain\Model\Dictionary;

use RGA\Domain\ValueObject;
use RGA\Infrastructure\Model\Translate;

class DictionaryLocale
	implements Translate\Translatable
{
	use Translate\Translated;

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
	 * @param ValueObject\Dictionary\Entry $entry
	 */
	public function setEntry(ValueObject\Dictionary\Entry $entry): void
	{
		$this->entry = $entry->getValue();
	}
}