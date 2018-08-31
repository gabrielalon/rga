<?php

namespace RGA\Domain\Model\Dictionary\Command;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class CreateDictionaryHandler
	implements CommandHandlerInterface
{
	/** @var DictionaryRepository */
	private $repository;
	
	/**
	 * @param DictionaryRepository $repository
	 */
	public function __construct(DictionaryRepository $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	 * @param MessageInterface|CreateDictionary $message
	 */
	public function run(MessageInterface $message): void
	{
		$dictionary = Dictionary::createNewDictionary(
			Dictionary\Uuid::fromString($message->getUuid()),
			Dictionary\Type::fromString($message->getType()),
			Dictionary\Entries::fromArray($message->getValues())
		);
		
		$this->repository->save($dictionary);
	}
}