<?php

namespace RGA\Infrastructure\Model\Translate;

interface Translatable
{
	/**
	 * @param string $code
	 */
	public function setLocale(string $code);
	
	/**
	 * @return string
	 */
	public function getLocale();
}