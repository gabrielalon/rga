<?php

namespace RGA\Application\Command\CommandHandler;

use RGA\Application\Command\Command\State\CreateState;
use RGA\Application\Command\Command\State\DeleteState;
use RGA\Application\Command\CommandHandling\AbstractCommandHandler;
use RGA\Domain\Model\State\State;
use RGA\Domain\Validation\AssertionConcern;
use RGA\Infrastructure\Persist\State\StateRepositoryInterface;

class StateCommandHandler
	extends AbstractCommandHandler
{
	/** @var StateRepositoryInterface */
	private $stateRepository;

	/**
	 * @param StateRepositoryInterface $stateRepository
	 */
	public function __construct(StateRepositoryInterface $stateRepository)
	{
		$this->stateRepository = $stateRepository;
	}

	/**
	 * @param CreateState $command
	 */
	public function handleCreateState(CreateState $command): void
	{
		$state = new State(
			$command->getUuid(),
			$command->isSendingEmail(),
			$command->getColorCode(),
			$command->getNames(),
			$command->getEmailSubjects(),
			$command->getEmailBodies()
		);

		$state->setIsEditable(true);
		$state->setIsDeletable(true);
		$state->setIsRejectable(false);
		$state->setIsCloseable(false);
		$state->setIsFinishable(false);

		$this->stateRepository->save($state);
	}

	public function handleDeleteState(DeleteState $command): void
	{
		$state = $this->stateRepository->find($command->getId());
		AssertionConcern::assertArgumentIsDeletableState($state, 'cannot_remove_irremovable_state');

		$this->stateRepository->delete($command->getId());
	}
}