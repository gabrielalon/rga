<?php

namespace RGA\Domain\Validation\Base;

use Ayeo\Validator\ValidationRules;
use Ayeo\Validator\Constraint;
use RGA\Domain\Validation\State\Constraint as StateConstraint;
use RGA\Domain\Validation\Uuid\Constraint as UuidConstraint;
use RGA\Infrastructure\Persist;

class RgaStateValidationRules
	extends ValidationRules
{
	/** @var Persist\State\StateRepositoryInterface */
	private $stateRepository;
	
	/**
	 * @param Persist\State\StateRepositoryInterface $stateRepository
	 */
	public function __construct(Persist\State\StateRepositoryInterface $stateRepository)
	{
		$this->stateRepository = $stateRepository;
	}
	
	public function getRules()
	{
		return [
			['stateUuid', new UuidConstraint\Uuid()],
			['stateUuid', new StateConstraint\Exist($this->stateRepository)],
			
			['adminNotesForApplicant', new Constraint\MaxLength(65535)]
		];
	}
}