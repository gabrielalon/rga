<?php

namespace RGA\Infrastructure\Model\Translate;

trait Localed
{
	/** @var LocaleCollector */
	protected $locales;
	
	/**
	 * @return LocaleCollector
	 */
	public function getLocales(): LocaleCollector
	{
		return $this->locales;
	}
	
	/**
	 * @param LocaleCollector $locales
	 */
	public function setLocales(LocaleCollector $locales): void
	{
		$this->locales = $locales;
	}
	
	/**
	 * @param string $locale
	 * @return Translatable
	 */
	public function getLocale($locale)
	{
		return $this->locales->offsetGet($locale);
	}
}