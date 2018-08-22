<?php

namespace RGA\Domain\Validation\State\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use function preg_match;

class HexColor
	extends AbstractConstraint
{
	public function run($value)
	{
		if (1 !== preg_match('/^#[a-f0-9]{6}$/i', $value))
		{
			$this->addError('hex_color_not_valid');
			
			return;
		}
	}
}