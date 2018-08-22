<?php

namespace RGA\Application\Log\Type;

use RGA\Infrastructure\Log\Type\LogTypeInterface;

class ChangeApplicantData
	implements LogTypeInterface
{
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'change_applicant_data';
	}
}