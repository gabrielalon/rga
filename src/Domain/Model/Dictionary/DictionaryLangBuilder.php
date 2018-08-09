<?php

namespace RGA\Domain\Model\Dictionary;

class DictionaryLangBuilder
{
	/** @var string */
	private $languageCode;

	/**
	 * @param string $languageCode
	 */
	public function __construct($languageCode)
	{
		$this->languageCode = $languageCode;
	}

	/**
	 * @param string $entry
	 * @return DictionaryLang
	 */
	public function create($entry): DictionaryLang
	{
		$model = new DictionaryLang();
		$model->setLanguageCode($this->languageCode);
		$model->setEntry($entry);

		return $model;
	}
}