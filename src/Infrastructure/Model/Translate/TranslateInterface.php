<?php

namespace RGA\Infrastructure\Model\Translate;

interface TranslateInterface
{
	/**
	 * @param string $code
	 */
	public function setLanguageCode(string $code): void;
	
	/**
	 * @return string
	 */
	public function getLanguageCode(): string;
}