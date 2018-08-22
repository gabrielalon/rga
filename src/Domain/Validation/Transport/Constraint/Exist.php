<?php

namespace RGA\Domain\Validation\Transport\Constraint;

use Ayeo\Validator\Constraint\AbstractConstraint;
use RGA\Infrastructure\Persist\Exception\NotFound;
use RGA\Infrastructure\Persist\Transport\TransportRepositoryInterface;

class Exist
	extends AbstractConstraint
{
	/** @var TransportRepositoryInterface */
	private $repository;
	
	public function __construct(TransportRepositoryInterface $repository)
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
			$this->addError('transport_does_not_exist');
		}
	}
}