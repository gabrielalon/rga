<?php

namespace RGA\Domain\Validation\Lang\Constraint;

use Ayeo\Validator;
use RGA\Domain\Validation\Lang\LangValidationRules;
use RGA\Infrastructure\Model\Translate;

class Lang
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
	 * @param Translate\Lang\Collector $value
	 */
	public function run($value)
	{
		/** @var Translate\TranslateInterface $model */
		foreach ($value as $model)
		{
			$validator = new Validator\Validator(new LangValidationRules($this->field));
			$validator->validate($model);
			
			$this->mergeErrors($model->getLanguageCode(), $validator->getErrors());
		}
	}
	
	/**
	 * @param string $languageCode
	 * @param Validator\Error[] $errors
	 */
	private function mergeErrors($languageCode, $errors)
	{
		foreach ($errors as $error)
		{
			$message = sprintf('%s_%s', $languageCode, $error->getMessage());
			$this->addError($message, $error->getValue());
		}
	}
}