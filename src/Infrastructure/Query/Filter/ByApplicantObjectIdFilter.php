<?php

namespace RGA\Infrastructure\Query\Filter;

use RGA\Infrastructure\SegregationSourcing\Query\Query\Viewable;

class ByApplicantObjectIdFilter extends \FilterIterator
{
	/** @var int */
	private $applicantObjectId;

	/**
	 * @param int $applicantObjectId
	 */
	public function setApplicantObjectId(int $applicantObjectId): void
	{
		$this->applicantObjectId = $applicantObjectId;
	}

	public function hasApplicantObjectId(int $applicantObjectId): bool
	{
		return $this->applicantObjectId === $applicantObjectId;
	}

	/**
	 * @return bool
	 */
	public function accept(): bool
	{
		/** @var Viewable $view */
		$view = $this->getInnerIterator()->current();

		try {
			$reflection = new \ReflectionClass($view);
			$method = $reflection->getMethod('applicantObjectId');

			return $this->hasApplicantObjectId($method->invoke($view));
		} catch (\Exception $e) {
			return false;
		}
	}
}
