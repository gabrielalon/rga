<?php

namespace RGA\Domain\ValueObject\Lang;

class Lang
{
	/** @var array */
	private $data;
	
	/** @var string[] */
	private $supportedLanguageCodes = ['pl', 'en'];
	
	/**
	 * @param array $data
	 */
	public function __construct($data = [])
	{
		$this->data = $data;
	}
	
	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}
	
	/**
	 * @param string $field
	 * @param string $lang
	 * @return string
	 */
	public function getForLang($field, $lang): string
	{
//		$key = sprintf('%s__%s', $field, $lang);
		
		return $this->data[$lang][$field] ?? '';
	}
	
	/**
	 * @return array
	 */
	public function getSupportedLanguageCodes(): array
	{
		return $this->supportedLanguageCodes;
	}
}