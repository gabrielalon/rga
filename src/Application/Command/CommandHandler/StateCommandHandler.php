<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command;
use RGA\Domain\Model\State;
use RGA\Domain\Validation;
use RGA\Infrastructure\Persist\State\StateRepositoryInterface;

class StateCommandHandler
	extends Command\CommandHandling\AbstractCommandHandler
{
	/** @var StateRepositoryInterface */
	private $repository;
	
	/**
	 * @param StateRepositoryInterface $stateRepository
	 */
	public function __construct(StateRepositoryInterface $stateRepository)
	{
		$this->repository = $stateRepository;
	}
	
	/**
	 * @param Command\Command\State\CreateState $command
	 */
	public function handleCreateState(Command\Command\State\CreateState $command): void
	{
		$builder = State\Builder\State::init($command->getUuid());
		$builder->setIsEditable($command->isEditable());
		$builder->setIsDeletable($command->isDeletable());
		$builder->setIsRejectable($command->isRejectable());
		$builder->setIsCloseable($command->isCloseable());
		$builder->setIsFinishable($command->isFinishable());
		$builder->setIsSendingEmail($command->isSendingEmail());
		$builder->setColorCode($command->getColorCode());
		$builder->setLocale($command->getNames(), $command->getEmailSubjects(), $command->getEmailBodies());
		
		$this->save($builder->build());
	}
	
	/**
	 * @param Command\Command\State\UpdateState $command
	 */
	public function handleUpdateState(Command\Command\State\UpdateState $command): void
	{
		$entity = $this->repository->find($command->getUuid());
		
		$builder = new State\Builder\State($entity);
		$builder->setIsEditable($command->isEditable());
		$builder->setIsDeletable($command->isDeletable());
		$builder->setIsRejectable($command->isRejectable());
		$builder->setIsCloseable($command->isCloseable());
		$builder->setIsFinishable($command->isFinishable());
		$builder->setIsSendingEmail($command->isSendingEmail());
		$builder->setColorCode($command->getColorCode());
		$builder->setLocale($command->getNames(), $command->getEmailSubjects(), $command->getEmailBodies());
		
		$this->save($builder->build());
	}
	
	/**
	 * @param State\State $model
	 */
	private function save(State\State $model): void
	{
		$this->validate(new Validation\State\StateValidationRules(), $model);
		
		$this->repository->save($model);
	}
	
	/**
	 * @param Command\Command\State\DeleteState $command
	 */
	public function handleDeleteState(Command\Command\State\DeleteState $command): void
	{
		$state = $this->repository->find($command->getId());
		Validation\AssertionConcern::assertArgumentIsDeletableState($state, 'cannot_remove_irremovable_state');
		
		$this->repository->delete($command->getId());
	}
}