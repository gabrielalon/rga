<?php

namespace RGA\Domain\Validation\Lang;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\Lang\Constraint\LanguageCode as ConstraintLanguageCode;

class LangValidationRules
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
			[$this->field, new Constraint\NotNull()],
			
			['languageCode', new ConstraintLanguageCode()]
		];
	}
}