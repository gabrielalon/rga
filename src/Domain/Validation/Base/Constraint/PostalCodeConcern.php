<?php

namespace RGA\Domain\Validation\Base\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;

class PostalCodeConcern
	extends AbstractConstraint
{
	public function run($value)
	{
		/** @var boolean $isValid */
		$isValid = (1 === preg_match('/^[0-9a-zA-Z\-]{4,10}$/', $value));
		
		if ($isValid === false)
		{
			$this->addError('postal_code_invalid_format');
		}
	}
}