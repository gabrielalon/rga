<?php

namespace RGA\Infrastructure\Model\Translate;

trait Translated
{
	/** @var string */
	protected $languageCode;
	
	/**
	 * @return string
	 */
	public function getLanguageCode()
	{
		return $this->languageCode;
	}
	
	/**
	 * @param string $languageCode
	 */
	public function setLanguageCode(string $languageCode)
	{
		$this->languageCode = $languageCode;
	}
}