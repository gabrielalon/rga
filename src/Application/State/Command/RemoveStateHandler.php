<?php

namespace RGA\Application\State\Command;

use RGA\Infrastructure\Persist\State\StateRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class RemoveStateHandler
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
	 * @param MessageInterface|RemoveState $message
	 */
	public function run(MessageInterface $message): void
	{
		$state = $this->repository->find($message->getIdentifier());
		
		$state->removeExistingState();
		
		$this->repository->save($state);
	}
}