<?php

namespace RGA\Domain\Model\Source\Condition\Ownership;

use RGA\Application\Assert;
use RGA\Domain\Model\Rga\Rga\Applicant\Applicant;
use RGA\Domain\Model\Source\RgaObject;
use RGA\Infrastructure\Source\Service\StandardService;

class BelongsTo
	extends Assert\Assertion
{
	const INVALID_OWNERSHIP = 903;
	
	/**
	 * @param Applicant $applicant
	 * @param RgaObject $source
	 * @throws Assert\Exception\AssertionFailedException
	 */
	public static function assert(Applicant $applicant, RgaObject $source): void
	{
		$isValid = (
			(
				$applicant->getId() === $source->getApplicant()->getId() &&
				$applicant->getType() === $source->getApplicant()->getType()
			)
			||
			(
				0 === $applicant->getId() || 0 === $source->getApplicant()->getId() // some kind of guest
			)
			||
			(
				$source->getType() === (new StandardService())->sourceType()
			)
		);
		
		if (false === $isValid)
		{
			$message = static::generateMessage('Applicant does not own rga');
			throw static::createException($source, $message, self::INVALID_OWNERSHIP);
		}
	}
}