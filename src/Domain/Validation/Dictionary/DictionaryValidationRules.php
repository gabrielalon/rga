<?php

namespace RGA\Domain\Validation\Dictionary;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\Translate\Constraint\DataLocale as ConstraintLang;
use RGA\Domain\Validation\Uuid\Constraint\Uuid as ConstraintUuid;
use RGA\Domain\Validation\Dictionary\Constraint\Type as ConstraintType;

class DictionaryValidationRules
	extends ValidationRules
{
	public function getRules()
	{
		return [
			['uuid', new ConstraintUuid()],

			['type', new Constraint\NonEmpty()],
			['type', new ConstraintType()],

			['locales', new ConstraintLang('entry')]
		];
	}
}