<?php

namespace RGA\Domain\Model\Behaviour\Enum;

use RGA\Application\Enum;

class Type
	extends Enum\Enum
{
	public const __default = Type::COMPLAINT;
	
	public const COMPLAINT = 'complaint';
	public const RETURN = 'return';
}