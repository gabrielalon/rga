<?php

namespace RGA\Application\Behaviour\Command;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class ChangeBehaviourHandler
	implements CommandHandlerInterface
{
	/** @var BehaviourRepository */
	private $repository;
	
	/**
	 * @param BehaviourRepository $repository
	 */
	public function __construct(BehaviourRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|ChangeBehaviour $message
	 */
	public function run(MessageInterface $message): void
	{
		$behaviour = $this->repository->find($message->getIdentifier()
		);
		
		$behaviour->changeExistingBehaviour(
			Behaviour\Names::fromArray($message->getNames()),
			Behaviour\Active::fromBoolean($message->isActive())
		);
		
		$this->repository->save($behaviour);
	}
}