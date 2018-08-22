<?php

namespace RGA\Domain\Validation\Transport\Constraint;

use Ayeo\Validator;
use RGA\Domain\Model\Transport;
use RGA\Domain\Validation\Transport\TransportAliasValidationRules;

class Alias
	extends Validator\Constraint\AbstractConstraint
{
	/**
	 * @param Transport\TransportAliasCollector $value
	 */
	public function run($value)
	{
		/** @var Transport\TransportAlias $model */
		foreach ($value as $model)
		{
			$validator = new Validator\Validator(new TransportAliasValidationRules());
			$validator->validate($model);
			
			$this->mergeErrors($model->getName(), $validator->getErrors());
		}
	}
	
	/**
	 * @param string $alias
	 * @param Validator\Error[] $errors
	 */
	private function mergeErrors($alias, $errors)
	{
		foreach ($errors as $error)
		{
			$message = sprintf('%s_%s', $alias, $error->getMessage());
			$this->addError($message, $error->getValue());
		}
	}
}