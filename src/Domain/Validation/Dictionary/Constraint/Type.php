<?php

namespace RGA\Domain\Validation\Dictionary\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Application\Enum\Dictionary\DictionaryType;

class Type
	extends AbstractConstraint
{
	public function run($value)
	{
		if (false === DictionaryType::isValid($value))
		{
			$this->addError('dictionary_type_not_valid');
			
			return;
		}
	}
}