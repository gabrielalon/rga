<?php

namespace RGA\Infrastructure\Model\Translate;

trait Translated
{
	/** @var string */
	protected $locale;
	
	/**
	 * @return string
	 */
	public function getLocale(): string
	{
		return $this->locale;
	}
	
	/**
	 * @param string $locale
	 */
	public function setLocale(string $locale): void
	{
		$this->locale = $locale;
	}
}