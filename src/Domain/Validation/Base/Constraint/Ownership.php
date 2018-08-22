<?php

namespace RGA\Domain\Validation\Base\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Domain\Model;

class Ownership
	extends AbstractConstraint
{
	/** @var Model\Base\Rga */
	private $rga;
	
	/** @var Model\Source\RgaObject */
	private $rgaObject;
	
	/**
	 * @param Model\Base\Rga $rga
	 * @param Model\Source\RgaObject $rgaObject
	 */
	public function __construct(
		Model\Base\Rga $rga,
		Model\Source\RgaObject $rgaObject
	)
	{
		$this->rga = $rga;
		$this->rgaObject = $rgaObject;
	}
	
	
	public function run($value)
	{
		$isValid = (
			$this->rgaObject->getApplicant()->getId() === $this->rga->getApplicantObjectID() &&
			$this->rgaObject->getApplicant()->getType() === $this->rga->getApplicantObjectType()
		);
		
		if (false === $isValid)
		{
			$this->addError('applicant_does_not_own_rga');
		}
	}
}