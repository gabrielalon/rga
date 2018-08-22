<?php

namespace RGA\Application\Log\Type;

use RGA\Infrastructure\Log\Type\LogTypeInterface;

class MakeType
	implements LogTypeInterface
{
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'make';
	}
}