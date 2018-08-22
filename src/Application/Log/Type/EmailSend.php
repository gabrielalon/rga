<?php

namespace RGA\Application\Log\Type;

use RGA\Infrastructure\Log\Type\LogTypeInterface;

class EmailSend
	implements LogTypeInterface
{
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'email_send';
	}
}