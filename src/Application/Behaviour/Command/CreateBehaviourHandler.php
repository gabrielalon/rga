<?php

namespace RGA\Application\Behaviour\Command;

use RGA\Domain\Model\Behaviour\Behaviour;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class CreateBehaviourHandler
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
	 * @param MessageInterface|CreateBehaviour $message
	 */
	public function run(MessageInterface $message): void
	{
		$behaviour = Behaviour::createNewBehaviour(
			Behaviour\Uuid::fromString($message->getIdentifier()),
			Behaviour\Type::fromString($message->getType()),
			Behaviour\Names::fromArray($message->getNames()),
			Behaviour\Active::fromBoolean($message->isActive())
		);
		
		$this->repository->save($behaviour);
	}
}