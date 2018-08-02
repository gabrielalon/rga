<?php

namespace RGA\Domain\Validation\Uuid\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;

class Uuid
	extends AbstractConstraint
{
	public function run($value)
	{
		if (false === \Ramsey\Uuid\Uuid::isValid($value))
		{
			$this->addError('uuid_not_valid');
			
			return;
		}
	}
}