<?php

namespace RGA\Domain\Validation\State\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Infrastructure\Persist\State\StateRepositoryInterface;

class Exist
	extends AbstractConstraint
{
	/** @var StateRepositoryInterface */
	private $repository;
	
	public function __construct(StateRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}
	
	public function run($value)
	{
		try
		{
			$this->repository->find($value);
		}
		catch (NotFound $e)
		{
			$this->addError('state_does_not_exist');
		}
	}
}