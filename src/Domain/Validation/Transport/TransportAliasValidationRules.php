<?php

namespace RGA\Domain\Validation\Transport;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;

class TransportAliasValidationRules
	extends ValidationRules
{
	public function getRules()
	{
		return [
			['name', new Constraint\NotNull()],
			['name', new Constraint\MinLength(1)],
			['name', new Constraint\MaxLength(255)],
		];
	}
}