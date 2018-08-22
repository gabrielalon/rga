<?php

namespace RGA\Domain\ValueObject\Translate;

use RGA\Domain\Validation\AssertionConcern;

class DataLocale
{
	/** @var array */
	private $data;

	/** @var string[] */
	private $locales;
	
	/**
	 * First argument is for i-sklep forms, ex:
	 * [
	 * 	name__pl => some pl name,
	 * 	name__en => some en name
	 * ]
	 *
	 * @param array $data
	 * @param array $locales
	 * @throws \InvalidArgumentException
	 */
	public function __construct($data = [], $locales = ['pl', 'en'])
	{
		$this->data = $data;
		$this->locales = $locales;
		
		AssertionConcern::assertArgumentIsLocalesValid($locales, 'unsupported_locales');
	}
	
	/**
	 * @return array
	 */
	public function getLocales()
	{
		return $this->locales;
	}

	/**
	 * @param string $field
	 * @param string $lang
	 * @param string $default
	 * @return string
	 */
	public function get($field, $lang, $default = ''): string
	{
		$key = sprintf('%s__%s', $field, $lang);

		return $this->data[$key] ?? $default;
	}
	
	/**
	 * @param string $field
	 * @param string $default
	 * @return array
	 */
	public function getAll($field, $default = '') : array
	{
		$data = [];
		
		foreach ($this->getLocales() as $locale)
		{
			$data[$locale] = $this->get($field, $locale, $default);
		}
		
		return $data;
	}
}