<?php

namespace RGA\Domain\Validation\Translate\Constraint;

use Ayeo\Validator;
use RGA\Domain\Validation\Translate\LocaleValidationRules;
use RGA\Infrastructure\Model\Translate;

class DataLocale
	extends Validator\Constraint\AbstractConstraint
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
	
	/**
	 * @param Translate\LocaleCollector $value
	 */
	public function run($value)
	{
		/** @var Translate\Translatable $model */
		foreach ($value as $model)
		{
			$validator = new Validator\Validator(new LocaleValidationRules($this->field));
			$validator->validate($model);
			
			$this->mergeErrors($model->getLocale(), $validator->getErrors());
		}
	}
	
	/**
	 * @param string $locale
	 * @param Validator\Error[] $errors
	 */
	private function mergeErrors($locale, $errors)
	{
		foreach ($errors as $error)
		{
			$message = sprintf('%s_%s', $locale, $error->getMessage());
			$this->addError($message, $error->getValue());
		}
	}
}