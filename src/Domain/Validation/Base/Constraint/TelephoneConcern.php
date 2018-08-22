<?php

namespace RGA\Domain\Validation\Base\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;

class TelephoneConcern
	extends AbstractConstraint
{
	public function run($value)
	{
		$hasOnlyValidCharacters = mb_strlen(preg_replace('#[-+() 0-9]#', '', $value)) == 0;
		$hasEnoughDigits = mb_strlen(preg_replace('#[^0-9]#', '', $value)) >= 7;
		
		/** @var boolean $isValid */
		$isValid = $hasOnlyValidCharacters && $hasEnoughDigits;
		
		if ($isValid === false)
		{
			$this->addError('phone_number_invalid_format');
		}
	}
}