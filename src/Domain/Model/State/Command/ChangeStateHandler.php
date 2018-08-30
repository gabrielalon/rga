<?php

namespace RGA\Domain\Model\State\Command;

use RGA\Domain\Model\State\State;
use RGA\Infrastructure\Persist\State\StateRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class ChangeStateHandler
	implements CommandHandlerInterface
{
	/** @var StateRepository */
	private $repository;
	
	/**
	 * @param StateRepository $repository
	 */
	public function __construct(StateRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|ChangeState $message
	 */
	public function run(MessageInterface $message): void
	{
		$state = $this->repository->find($message->getUuid());
		
		$state->changeExistingState(
			State\IsEditable::fromBoolean($message->isEditable()),
			State\IsDeletable::fromBoolean($message->isDeletable()),
			State\IsRejectable::fromBoolean($message->isRejectable()),
			State\IsFinishable::fromBoolean($message->isFinishable()),
			State\IsCloseable::fromBoolean($message->isCloseable()),
			State\IsSendingEmail::fromBoolean($message->isSendingEmail()),
			State\ColorCode::fromString($message->getColorCode()),
			State\Names::fromArray($message->getNames()),
			State\EmailSubjects::fromArray($message->getEmailSubjects()),
			State\EmailBodies::fromArray($message->getEmailBodies())
		);
		
		$this->repository->save($state);
	}
}