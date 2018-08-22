<?php

namespace RGA\Application\Log\Type;

use RGA\Infrastructure\Log\Type\LogTypeInterface;

class DeleteType
	implements LogTypeInterface
{
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'delete';
	}
}