<?php

namespace RGA\Domain\Validation\Translate\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;

class Locale
	extends AbstractConstraint
{
	/** @var string[] */
	private static $allowedCodes = ['en', 'pl', 'de', 'ru'];
	
	public function run($value)
	{
		if (false === in_array($value, Locale::$allowedCodes))
		{
			$this->addError('language_code_not_valid');
			
			return;
		}
	}
}