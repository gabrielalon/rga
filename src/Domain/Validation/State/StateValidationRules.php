<?php

namespace RGA\Domain\Validation\State;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\State\Constraint\HexColor;
use RGA\Domain\Validation\Translate\Constraint\DataLocale as ConstraintLang;
use RGA\Domain\Validation\Uuid\Constraint\Uuid as ConstraintUuid;

class StateValidationRules
	extends ValidationRules
{
	public function getRules()
	{
		return [
			['uuid', new ConstraintUuid()],
			
			['colorCode', new Constraint\NotNull()],
			['colorCode', new HexColor()],
			
			['locales', new ConstraintLang('name')],
			['locales', new ConstraintLang('emailSubject')],
			['locales', new ConstraintLang('emailBody')]
		];
	}
}