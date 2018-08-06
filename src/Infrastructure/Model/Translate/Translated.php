<?php

namespace RGA\Infrastructure\Model\Translate;

trait Translated
{
	/** @var string */
	protected $languageCode;
	
	/**
	 * @return string
	 */
	public function getLanguageCode(): string
	{
		return $this->languageCode;
	}
	
	/**
	 * @param string $languageCode
	 */
	public function setLanguageCode(string $languageCode): void
	{
		$this->languageCode = $languageCode;
	}
}