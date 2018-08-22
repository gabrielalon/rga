<?php

namespace RGA\Domain\Validation\Base\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Application\Enum\Source\SourceObjectType;

class SourceObjectTypeConcern
	extends AbstractConstraint
{
	public function run($value)
	{
		if (false === SourceObjectType::isValid($value))
		{
			$this->addError('source_object_type_invalid');
		}
	}
}