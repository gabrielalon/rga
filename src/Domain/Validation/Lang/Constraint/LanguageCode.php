<?php

namespace RGA\Domain\Validation\Lang\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;

class LanguageCode
	extends AbstractConstraint
{
	/** @var string[] */
	private static $allowedCodes = ['en', 'pl', 'de', 'ru'];
	
	public function run($value)
	{
		if (false === in_array($value, LanguageCode::$allowedCodes))
		{
			$this->addError('language_code_not_valid');
			
			return;
		}
	}
}