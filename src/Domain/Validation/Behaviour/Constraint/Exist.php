<?php

namespace RGA\Domain\Validation\Behaviour\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepositoryInterface;
use RGA\Infrastructure\Persist\Exception\NotFound;

class Exist
	extends AbstractConstraint
{
	/** @var BehaviourRepositoryInterface */
	private $repository;
	
	public function __construct(BehaviourRepositoryInterface $repository)
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
			$this->addError('behaviour_does_not_exist');
		}
	}
}