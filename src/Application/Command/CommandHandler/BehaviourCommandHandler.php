<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command;
use RGA\Domain\Model\Behaviour;
use RGA\Domain\Validation;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepositoryInterface;

class BehaviourCommandHandler
	extends Command\CommandHandling\AbstractCommandHandler
{
	/** @var BehaviourRepositoryInterface */
	private $repository;

	/**
	 * @param BehaviourRepositoryInterface $repository
	 */
	public function __construct(BehaviourRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @param Command\Command\Behaviour\CreateBehaviour $command
	 */
	public function handleCreateBehaviour(Command\Command\Behaviour\CreateBehaviour $command): void
	{
		$builder = Behaviour\Builder\Behaviour::init($command->getUuid());
		$builder->setType($command->getType());
		$builder->setIsActive($command->isActive());
		$builder->setNames($command->getNames());
		
		$this->save($builder->build());
	}

	/**
	 * @param Command\Command\Behaviour\UpdateBehaviour $command
	 */
	public function handleUpdateBehaviour(Command\Command\Behaviour\UpdateBehaviour $command): void
	{
		$model = $this->repository->find($command->getUuid());
		
		$builder = new Behaviour\Builder\Behaviour($model);
		$builder->setType($command->getType());
		$builder->setIsActive($command->isActive());
		$builder->setNames($command->getNames());
		
		$this->save($builder->build());
	}
	
	/**
	 * @param Behaviour\Behaviour $model
	 */
	private function save(Behaviour\Behaviour $model)
	{
		$this->validate(new Validation\Behaviour\BehaviourValidationRules(), $model);
		
		$this->repository->save($model);
	}
}