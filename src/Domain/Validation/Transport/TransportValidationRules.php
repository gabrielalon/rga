<?php

namespace RGA\Domain\Validation\Transport;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\Translate\Constraint\DataLocale as ConstraintLang;
use RGA\Domain\Validation\Transport\Constraint\Alias as ConstraintAlias;
use RGA\Domain\Validation\Uuid\Constraint\Uuid as ConstraintUuid;

class TransportValidationRules
	extends ValidationRules
{
	public function getRules()
	{
		return [
			['uuid', new ConstraintUuid()],
			
			['courierSymbol', new Constraint\NotNull()],
			['courierSymbol', new Constraint\MinLength(1)],
			['courierSymbol', new Constraint\MaxLength(255)],
			
			['aliases', new ConstraintAlias()],
			
			['locales', new ConstraintLang('name')],
		];
	}
}