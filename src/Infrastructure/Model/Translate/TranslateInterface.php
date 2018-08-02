<?php

namespace RGA\Infrastructure\Model\Translate;

interface TranslateInterface
{
	/**
	 * @param string $code
	 */
	public function setLanguageCode($code);
	
	/**
	 * @return string
	 */
	public function getLanguageCode();
}