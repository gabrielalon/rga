<?php

namespace RGA\Domain\Validation\Behaviour\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Application\Enum\Behaviour\BehaviourType;

class Type
	extends AbstractConstraint
{
	public function run($value)
	{
		if (false === BehaviourType::isValid($value))
		{
			$this->addError('behaviour_type_not_valid');
			
			return;
		}
	}
}