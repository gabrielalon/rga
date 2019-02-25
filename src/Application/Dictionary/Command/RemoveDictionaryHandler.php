<?php

namespace RGA\Application\Dictionary\Command;

use RGA\Infrastructure\Persist\Dictionary\DictionaryRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Domain\MessageInterface;

class RemoveDictionaryHandler
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
	 * @param MessageInterface|RemoveDictionary $message
	 */
	public function run(MessageInterface $message): void
	{
		$dictionary = $this->repository->find($message->getIdentifier());
		
		$dictionary->removeExistingDictionary();
		
		$this->repository->save($dictionary);
	}
}