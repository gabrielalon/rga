<?php

namespace RGA\Domain\Validation\Behaviour;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\Lang\Constraint\Lang as ConstraintLang;
use RGA\Domain\Validation\Uuid\Constraint\Uuid as ConstraintUuid;
use RGA\Domain\Validation\Behaviour\Constraint\Type as ConstraintType;

class BehaviourValidationRules
	extends ValidationRules
{
	public function getRules()
	{
		return [
			['id', new ConstraintUuid()],
			
			['type', new Constraint\NonEmpty()],
			['type', new ConstraintType()],
			
			['lang', new ConstraintLang('name')]
		];
	}
}