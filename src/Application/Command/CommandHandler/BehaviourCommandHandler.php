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
		$builder = Behaviour\BehaviourBuilder::create($command->getUuid());
		$builder->setBehaviour($command->getBehaviour());
		$builder->setLang($command->getName());
		$model = $builder->extract();

		$this->validate(new Validation\Behaviour\BehaviourValidationRules(), $model);

		$this->repository->save($model);
	}

	/**
	 * @param Command\Command\Behaviour\UpdateBehaviour $command
	 */
	public function handleUpdateBehaviour(Command\Command\Behaviour\UpdateBehaviour $command): void
	{
		$model = $this->repository->find($command->getUuid());

		$builder = new Behaviour\BehaviourBuilder($model);
		$builder->setBehaviour($command->getBehaviour());
		$builder->setLang($command->getName());
		$model = $builder->extract();

		$this->validate(new Validation\Behaviour\BehaviourValidationRules(), $model);

		$this->repository->save($model);
	}
}