<?php

namespace RGA\Domain\Validation\Translate;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\Translate\Constraint\Locale as ConstraintLanguageCode;

class LocaleValidationRules
	extends ValidationRules
{
	/** @var string */
	private $field;
	
	/**
	 * @param string $field
	 */
	public function __construct($field)
	{
		$this->field = $field;
	}
	
	public function getRules()
	{
		return [
			[$this->field, new Constraint\NonEmpty()],
			
			['locale', new ConstraintLanguageCode()]
		];
	}
}