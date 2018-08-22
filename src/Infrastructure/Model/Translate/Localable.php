<?php

namespace RGA\Infrastructure\Model\Translate;

interface Localable
{
	/**
	 * @return LocaleCollector
	 */
	public function getLocales(): LocaleCollector;
	
	/**
	 * @param LocaleCollector $locales
	 */
	public function setLocales(LocaleCollector $locales): void;
}